<script setup>
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    ticket: Object
})


const emit = defineEmits()

const closeTicket = () => {
    axios.post(route('ticket.close'), props.ticket)
        .then(response => {
            usePage().props.flash.message = response.data.message
            emit('dataHaveToReload')
        })
}

const reopenTicket = () => {
    axios.post(route('ticket.reopen'), props.ticket)
        .then(response => {
            usePage().props.flash.message = response.data.message
            emit('dataHaveToReload')
        })
}

const closeTicketAsUnresolved = () => {
    axios.post(route('ticket.closeAsUnresolved'), props.ticket)
        .then(response => {
            usePage().props.flash.message = response.data.message
            emit('dataHaveToReload')
        })
}

const closeTicketAsResolved = () => {
    axios.post(route('ticket.closeAsResolved'), props.ticket)
        .then(response => {
            usePage().props.flash.message = response.data.message
            emit('dataHaveToReload')
        })
}

const reopenTicketAsUnresolved = () => {
    axios.post(route('ticket.reopenAsUnresolved'), props.ticket)
        .then(response => {
            usePage().props.flash.message = response.data.message
            emit('dataHaveToReload')
        })
}

const archiveTicket = () => {
    axios.post(route('ticket.archive'), props.ticket)
        .then(response => {
            usePage().props.flash.message = response.data.message
            emit('dataHaveToReload')
        })
}

const lockTicket = () => {
    axios.post(route('ticket.lock'), props.ticket)
        .then(response => {
            usePage().props.flash.message = response.data.message
            emit('dataHaveToReload')
        })
}

const unlockTicket = () => {
    axios.post(route('ticket.unlock'), props.ticket)
        .then(response => {
            usePage().props.flash.message = response.data.message
            emit('dataHaveToReload')
        })
}

const markTicketAsResolved = () => {
    axios.post(route('ticket.markAsResolved'), props.ticket)
        .then(response => {
            usePage().props.flash.message = response.data.message
            emit('dataHaveToReload')
        })
}
</script>

<template>
    <div class="w-11/12 h-fit m-2 p-5 flex flex-col justify-evenly" v-if="props.ticket != null">
        <div class="flex flex-row justify-end items-center">
            <el-dropdown>
                 <span class="el-dropdown-link">
                    <el-icon>
                        <font-awesome-icon align="left" icon="fa-ellipsis-vertical" />
                    </el-icon>
                </span>
                <template #dropdown>
                    <el-dropdown-menu>
                        <el-dropdown-item
                            :disabled="props.ticket.status === 'closed'"
                            @click="closeTicket"
                        >
                            Close Ticket
                        </el-dropdown-item>
                        <el-dropdown-item
                            :disabled="props.ticket.status === 'open'"
                            @click="reopenTicket"
                        >
                            Reopen Ticket
                        </el-dropdown-item>
                        <el-dropdown-item
                            :disabled="props.ticket.is_resolved === 1 || props.ticket.status === 'closed'"
                            @click="closeTicketAsResolved"
                        >
                            Close Ticket as resolved
                        </el-dropdown-item>
                        <el-dropdown-item
                            :disabled="props.ticket.is_resolved  !== 1"
                            @click="closeTicketAsUnresolved"
                        >
                            Close Ticket as unresolved
                        </el-dropdown-item>

                        <el-dropdown-item
                            :disabled="props.ticket.is_resolved  !== 1 || !props.ticket.status === 'closed'"
                            @click="reopenTicketAsUnresolved"
                        >
                            Reopen Ticket as unresolved
                        </el-dropdown-item>
                        <el-dropdown-item
                            divided
                            :disabled="props.ticket.status === 'archived'"
                            @click="archiveTicket"
                        >
                            Archive Ticket
                        </el-dropdown-item>
                        <el-dropdown-item
                            divided
                            :disabled="props.ticket.is_locked  === 1"
                            @click="lockTicket"
                        >
                            Lock Ticket
                        </el-dropdown-item>
                        <el-dropdown-item
                            :disabled="props.ticket.is_locked  !== 1"
                            @click="unlockTicket"
                        >
                            Unlock Ticket
                        </el-dropdown-item>
                        <el-dropdown-item
                            divided
                            :disabled="props.ticket.is_resolved  === 1"
                            @click="markTicketAsResolved"
                        >
                            Mark Ticket as resolved
                        </el-dropdown-item>
                    </el-dropdown-menu>
                </template>
            </el-dropdown>
        </div>
        <div class="max-h-[40vh] my-5 overflow-y-scroll">
            <span class="capitalize">
                {{ props.ticket.message }}
            </span>
        </div>
        <div class="card-footer flex flex-col justify-between space-y-2">
            <span class="flex justify-between">
                Assigned to:
                <el-tag effect="dark" type="warning" class="capitalize !text-black font-bold">{{ props.ticket.assigned_to_user.name }}</el-tag>
            </span>
            <span class="flex justify-between">
                Created by:
                <el-tag effect="dark" type="warning" class="capitalize !text-black font-bold">{{ props.ticket.user.name }}</el-tag>
            </span>
            <span class="flex justify-between">
                Created at:
                <el-tag effect="dark" type="warning" class="capitalize !text-black font-bold">
                    <timeago
                        v-if="new Date(props.ticket.created_at).setHours(new Date(props.ticket.created_at).getHours() + 24) >= Date.now()"
                        :datetime="props.ticket.created_at">
                    </timeago>
                    <span
                        v-if="new Date(props.ticket.created_at).setHours(new Date(props.ticket.created_at).getHours() + 24) < Date.now()"
                    >
                        {{ props.ticket.created_at.replace('T', ' ').split('.')[0].replaceAll('-', '.') }}
                    </span>
                </el-tag>
            </span>
        </div>
    </div>
</template>

<style scoped>

</style>
