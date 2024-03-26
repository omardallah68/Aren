<?php


namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Dompdf\Dompdf;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->select()->get();
        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $product = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'shipping_costs' => $request->input('shipping_costs'),
            'shipping_duration' => $request->input('shipping_duration'),
            'price' => $request->input('price'),
        ]);

        $product->save();

        return response()->json([
            'message' => 'Successfully saved! The Text already saved in Database',
            'bannerStyle' => 'success'
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function  buy(string $id)
    {
        $products = Product::all();

        $dompdf = new Dompdf();
        $html = '<table style="border-collapse: collapse; width: 100%;">
    <tr>
        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Name</th>
        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Description</th>
        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Amount</th>
        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Shipping costs</th>
        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Shipping duration</th>
        <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Price</th>
    </tr>';

        foreach ($products as $product) {
            $html .= '<tr>
        <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $product->name . '</td>
        <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $product->description . '</td>
        <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $product->amount . '</td>
        <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $product->shipping_costs . '</td>
        <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $product->shipping_duration . '</td>
        <td style="font-weight:bolder; border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $product->price . ' €</td>
    </tr>';
        }

        $html .= '</table>
    <p style="text-align: right; font-weight:bolder;">'. count($products) .' Products</p>
    <p class="footer-title">Copyright @ <span style="font-weight:bolder;">Aren</span></p>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');

        $dompdf->render();
        $dompdf->stream();
    }


}
