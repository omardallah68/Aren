<script setup>
const props = defineProps({
    ticket: Object
})
const emit = defineEmits()
</script>

<template>
    <el-card class="w-full m-2 p-5" @click="emit('openTicket', this)">
        <div
            class="card-header flex justify-between items-center capitalize left"
        >
            <el-tag>{{props.ticket.uuid}}</el-tag>
            <span>{{ props.ticket.title }}</span>
            <el-tag effect="dark"
                    :type="props.ticket.priority === 'low' ? 'success': '' ||
                           props.ticket.priority === 'normal' ? 'warning' : '' ||
                           props.ticket.priority === 'high' ? 'danger': ''"
            >
                <span class="text-black font-extrabold">
                    {{ props.ticket.priority }}
                </span>
            </el-tag>
        </div>
    </el-card>
</template>

<style scoped>

</style>
