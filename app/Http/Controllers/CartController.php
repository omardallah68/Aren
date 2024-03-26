<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Jackiedo\Cart\Cart;

class CartController extends Controller
{

    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function addItem($productId)
    {
        $product = Product::find($productId)->toArray();
        array_push($product, $product['title'] = $product['name'] );
        $this->cart->addItem($product);
        return response()->json([
            'message' => 'Added!'
        ], 200);
    }

    public function getCartItems()
    {
        $items = $this->cart->getDetails()->get('items');
        return response()->json($items);
    }

    public function  print()
    {

        $items = $this->cart->getDetails()->get('items');
        $products = [];
        foreach ($items as $item) {

            $product = Product::find($item->id);

            array_push($products, $product );
        }

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
