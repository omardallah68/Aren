<script setup>

import {onMounted, ref, reactive, watch} from "vue";
import {usePage} from "@inertiajs/vue3";
import TicketDetails from "@/Pages/Tickets/TicketDetails.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const page = usePage()

let users = ref([])

let tickets = ref([]);
let ticketsWithLowPriority = ref([]);
let ticketsWithNormalPriority = ref([]);
let ticketsWithHighPriority = ref([]);
let ticket = ref(null)

let toggleDrawer = ref(false)

const createTicketForm = reactive({
    uuid: '',
    title: '',
    message: '',
    priority: 'low',
    status: 'open',
    is_resolved: false,
    is_locked: false,
    assigned_to: ''
})

const createTicket = () => {
    page.props.loading = true
    console.log(createTicketForm)
    axios.post(route('ticket.store'), createTicketForm)
        .then(response => {
            getTickets()

            createTicketForm.uuid = ''
            createTicketForm.title = ''
            createTicketForm.message = ''
            createTicketForm.priority = 'low'
            createTicketForm.status = 'open'
            createTicketForm.is_resolved = false
            createTicketForm.is_locked = false
            createTicketForm.assigned_to = ''

            toggleDrawer.value = !toggleDrawer
            page.props.loading = false
        })
}

const getTickets = () => {
    page.props.loading = true
    axios.get(route('tickets.get'))
        .then(response => {
            tickets = response.data.tickets
            ticket.value = response.data.tickets[0]
            ticketsWithLowPriority = response.data.ticketsWithLowPriority
            ticketsWithNormalPriority = response.data.ticketsWithNormalPriority
            ticketsWithHighPriority = response.data.ticketsWithHighPriority
            page.props.loading = false
        })
}

const getUsers = () => {
    page.props.loading = true
    axios.get(route('users.get'))
        .then(response => {
            users = response.data
            page.props.loading = false
        })
}


const changeTicket = (response)=>{
    ticket.value = response.ticket
}

watch(() => tickets.value, (newValue) => {
    console.log(newValue)
} )

onMounted(()=>{
    getTickets()
    getUsers()
})
</script>

<template>
    <el-card>
        <PrimaryButton class="mb-5" type="button" id="button" @click="toggleDrawer = !toggleDrawer">
            New Ticket
        </PrimaryButton>
        <el-drawer v-model="toggleDrawer" size="50%">
            <template #header>
                <h3>New Ticket</h3>
            </template>
            <template #default>
                <el-form :model="createTicketForm" label-width="120px" label-position="left"
                         class="flex flex-col justify-center p-2">
                    <el-form-item label="uuid">
                        <el-input placeholder="uuid" type="text" v-model="createTicketForm.uuid"/>
                    </el-form-item>

                    <el-form-item label="Title">
                        <el-input placeholder="Title" type="text" v-model="createTicketForm.title"/>
                    </el-form-item>

                    <el-form-item label="Message">
                        <el-input placeholder="Message" type="textarea" v-model="createTicketForm.message" :rows="5"/>
                    </el-form-item>

                    <el-form-item label="Priority">
                        <el-input placeholder="Priority" type="text" v-model="createTicketForm.priority"/>
                    </el-form-item>

                    <el-form-item label="Status">
                        <el-input placeholder="Status" type="text" v-model="createTicketForm.status"/>
                    </el-form-item>

                    <el-form-item label="Is resolved">
                        <el-checkbox-button label="Is resolved" v-model="createTicketForm.is_resolved"/>
                    </el-form-item>

                    <el-form-item label="Is locked">
                        <el-checkbox-button label="Is locked" v-model="createTicketForm.is_locked"/>
                    </el-form-item>

                    <el-form-item label="Assign to">
                        <el-select v-model="createTicketForm.assigned_to">
                            <el-option v-for="user in users" :value="user.id" :key="user.id" :label="user.name"/>
                        </el-select>
                    </el-form-item>
                </el-form>
            </template>
            <template #footer>
                <el-form-item>
                    <el-button type="primary" @click="createTicket">Create</el-button>
                    <el-button>Cancel</el-button>
                </el-form-item>
            </template>
        </el-drawer>

        <el-table :data="tickets.length === 0 ? getTickets() : tickets" style="width: 100%">
            <el-table-column sortable label="UUID" prop="uuid" :min-width="20" align="center"/>
            <el-table-column type="expand" :min-width="10" align="center">
                <template #default="props">
                    <div class="flex justify-center">
                        <TicketDetails :ticket="props.row" @dataHaveToReload="getTickets"/>
                    </div>
                </template>
            </el-table-column>
            <el-table-column label="Title" prop="title" :min-width="30" class-name="capitalize" align="center"/>
            <el-table-column sortable label="Priority" prop="priority" :min-width="10" class-name="capitalize" align="center">
                <template #default="props">
                    <el-tag :type="props.row.priority === 'low' ? 'success' : '' ||
                                   props.row.priority === 'normal' ? 'warning' : ''||
                                   props.row.priority === 'high' ? 'danger' : ''"
                            class="capitalize"
                    >
                        {{ props.row.priority }}
                    </el-tag>
                </template>
            </el-table-column>
            <el-table-column label="Status" prop="status" :min-width="10" class-name="capitalize" align="center">
                <template #default="props">
                    <el-tag :type="props.row.status === 'open' ? 'warning' : '' ||
                                   props.row.status === 'closed' ? 'success' : '' ||
                                   props.row.status === 'archived' ? 'info' : '' "
                            :effect="props.row.status === 'archived' ? 'dark' : ''"
                            class="capitalize"
                    >
                        {{ props.row.status }}
                    </el-tag>
                </template>
            </el-table-column>
            <el-table-column label="Locked" prop="is_locked" :min-width="10" class-name="capitalize" align="center">
                <template #default="props">
                    <el-tag :type="props.row.is_locked ? 'danger' : 'success'"
                            class="capitalize"
                    >
                        {{ props.row.is_locked ? 'Locked' : 'Not Locked' }}
                    </el-tag>
                </template>
            </el-table-column>
            <el-table-column label="Resolved" prop="is_resolved" :min-width="10" class-name="capitalize" align="center">
                <template #default="props">
                    <el-tag :type="props.row.is_resolved ? 'success' : 'warning'"
                            class="capitalize"
                    >
                        {{ props.row.is_resolved ? 'Resolved' : 'Not Resolved' }}
                    </el-tag>
                </template>
            </el-table-column>
        </el-table>
    </el-card>
</template>

<style>
.el-table{
    --el-table-header-bg-color: rgba(0, 0, 0, 0.1) !important;
    --el-table-row-hover-bg-color: rgba(0, 0, 0, 0.2) !important;
    --el-table-tr-bg-color: rgba(0, 0, 0, 0) !important;
}

.el-card {
    --el-card-bg-color: #057AF0CC !important;
    --el-card-border-color: none !important;
}

.el-card.is-always-shadow {
    box-shadow: var(--el-box-shadow-dark) !important;
}
</style>
