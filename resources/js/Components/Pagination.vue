<template>
    <div>
        <Link
            v-if="links.length > 3"
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links"
            :href="link.url ? link.url : ''"
            :disabled="!link.url"
            v-html="link.label"
            class="px-1"
            :class="{ 'text-gray-300 pointer-events-none': ! link.url, 'font-extrabold text-lg pointer-events-none' : link.active }"
            preserve-scroll
        />
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    components: {Link},
    props: {
        links: Array,
    }
};
</script>
