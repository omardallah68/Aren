<script setup>
import {reactive, ref, watch} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AddAppointment from "@/Pages/AddAppointment.vue";
import AvailableHours from "@/Pages/AvailableHours.vue";
import FullCalendar from '@fullcalendar/vue3'
import {Head, usePage} from "@inertiajs/vue3";
import timeGridPlugin from "@fullcalendar/timegrid";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import DialogModal from "@/Components/DialogModal.vue";
import Counter from "@/Components/Counter.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import Modal from '@/Components/Modal.vue'
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    appointments: Object,
    business_hours: Array,
    sunday: Array,
    monday: Array,
    thursday: Array,
    wednesday: Array,
    tuesday: Array,
    friday: Array,
    saturday: Array,
})

const page = usePage()
const emit = defineEmits()


const showModal = ref(false)

const selectedDateTime = ref(null);

const appointments = ref(props.appointments);
const newAppointment = (data) => {
    appointments.value.push({
        'title': data.title,
        'start': data.start,
        'end': data.end,
        'description': data.description,
        'user': data.user
    })
}

const availableHours = ref(props.business_hours);

const newAvailableHours = (data) => {
    availableHours.value.push({
        'daysOfWeek': data.daysOfWeek,
        'startTime': data.startTime,
        'endTime': data.endTime,
    })
}

const form = reactive({
    id:'',
    start:'',
    end:'',
});

const openAppointment = ref(false);

const open = () => {
    openAppointment.value = true
}
const close = () => {
    openAppointment.value = false;
};

const calendarOptions = reactive({
    plugins: [timeGridPlugin, dayGridPlugin, interactionPlugin ],
    initialView: 'timeGridWeek',
    businessHours: availableHours,
    events: appointments,
    weekends: true,
    droppable: true,
    headerToolbar: {
        left: 'prev,today,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay' // user can switch between the two
    },
    height: 800,
    selectable: true,
    editable: true,
    slotLabelFormat:{ 'hour12': false, 'hour': '2-digit', 'minute':'2-digit'},
    slotMinTime: '00:00:00',
    slotMaxTime: '24:00:00',
    dayHeaderFormat:{ weekday: 'long', month: 'short', day: 'numeric', omitCommas: true },
    titleFormat: {
        month: '2-digit',
        year: 'numeric',
        day: 'numeric',
        weekday: 'long',
        omitCommas: true
    },
    eventBackgroundColor:'#057af0',
    eventBorderColor:'transparent',
    eventTextColor:'#FFFFFF',
    nowIndicator: true,
    eventResizableFromStart: true,
    eventDragMinDistance:15,
    eventResize: function(info) {
        axios.post(route('appointments.update'), {
            id: info.event.id,
            start: info.event.start,
            end: info.event.end,
        }).then((response) =>
        {
            if (page.props.flash === '') {
                page.props.flash = [];
            }
            page.props.flash.bannerStyle = response.data.style
            page.props.flash.message = response.data.message
        })
    },
    eventDrop: function(info) {
        axios.post(route('appointments.update'), {
            id: info.event.id,
            start: info.event.start,
            end: info.event.end,
        }).then((response) =>
        {
            if (page.props.flash === '') {
                page.props.flash = [];
            }
            page.props.flash.bannerStyle = 'success'
            page.props.flash.message = response.data.message
        })
    },
    dateClick: function(info){
        if(info) {
            const DateTime = []
            DateTime['start'] = info.startStr
            DateTime['end'] = info.endStr
            selectedDateTime.value = DateTime
            emit('appointment-selected', DateTime);
            document.getElementById("button").click();
        }
    },
    select: function(info) {
        if(info) {
            const DateTime = [info.startStr, info.endStr]
            selectedDateTime.value = DateTime
            emit('appointment-selected', DateTime);
            document.getElementById("button").click();
        }
    },
    selectConstraint: "businessHours",
    eventConstraint: "businessHours",
    eventMaxStack: 15,
    slotDuration: '00:15:00',


})

</script>

<template>
    <Head title="Calendar" />

    <div class="text-white">
        <AddAppointment
            @confirmed="showModal"
            @new-appointment="newAppointment"
            create-route="appointments.store"
            title="Add Appointment"
            content="New Appointment"
            placeholder="Appointment name"
            :appointment-selected="selectedDateTime"
        >
            <PrimaryButton type="button" id="button">
                Add a new Appointment
            </PrimaryButton>
        </AddAppointment>


        <AvailableHours
            v-if="$page.props.user_roles.includes('super-admin')"
            @new-available-hours="newAvailableHours"
            :available-hours="props.business_hours"
            :sunday="props.sunday"
            :monday="props.monday"
            :thursday="props.thursday"
            :wednesday="props.wednesday"
            :tuesday="props.tuesday"
            :friday="props.friday"
            :saturday="props.saturday"
            create-route="appointments.store"
            title="Available Hours"
            content="Set the available Hours"
            class="ml-2"
        >
            <PrimaryButton type="button">
                Set the available Hours
            </PrimaryButton>
        </AvailableHours>

        <FullCalendar
            :options='calendarOptions'
            class="mt-5"
        >
            <template #eventContent="arg">
                <span>
                    <span @click="open">
                        <div :title="arg.timeText
                            +`\n`+arg.event.title
                            +`\n`+arg.event.extendedProps.user.name
                            +`\n`+(isNaN(arg.event.extendedProps.description) ? arg.event.extendedProps.description : '')"
                             class="flex flex-col h-full overflow-hidden"
                        >
                            <div class="flex flex-col">
                                <div class="flex">
                                    {{ arg.timeText }}
                                </div>
                                <div class="flex font-bold">
                                    {{ arg.event.title }}
                                </div>
                                <div class="flex">
                                    {{ arg.event.extendedProps.user.name }}
                                </div>
                            </div>
                            <DialogModal :show="openAppointment" @close="close" :closeable="true">
                                <template #title>
                                    <div class="flex justify-center mt-10">
                                        {{ arg.event.start.toString().split('').slice(0, 15).toString().replaceAll(',', '') }}
                                    </div>
                                    <div class="flex justify-between px-10 mt-5">
                                        <div class="flex">
                                            {{ arg.event.title }}
                                        </div>
                                        <div class="flex">
                                            {{ arg.timeText }}
                                        </div>
                                    </div>
                                </template>

                                <template #content>
                                    <div class="flex px-10">
                                        {{ arg.event.extendedProps.description }}
                                    </div>
                                </template>
                                <template #footer>
                                    <div class="flex font-extrabold text-white px-10 mb-10">
                                        {{ arg.event.extendedProps.user.name }}
                                    </div>
                                </template>
                            </DialogModal>
                        </div>
                    </span>
                </span>
            </template>
        </FullCalendar>
    </div>
</template>
<style>
.fc-event {
    padding: 2px;
    -webkit-box-shadow: -2px 2px 2px 2px rgba(0,0,0,0.6) !important;
    -moz-box-shadow: -2px 2px 2px 2px rgba(0,0,0,0.6) !important;
    box-shadow: -2px 2px 7px 2px rgba(0,0,0,0.6) !important;
}
.fc-event-title {
    font-weight: bold;
}
.fc-day-today{
    background-color: #E8B20830 !important;
}
.fc-theme-standard td{
    border: 1px solid rgba(255, 255, 255, 0.25);
}
.fc-theme-standard th{
    border: 1px solid rgba(255, 255, 255, 0.50);
}
.fc-theme-standard .fc-scrollgrid{
    border: 1px solid rgba(255, 255, 255, 0.60);
}
.fc .fc-non-business{
    background-color: rgba(255, 255, 255, 0.10);
}
.fc .fc-timegrid-now-indicator-line{
    border-style: dotted;
    border-width: 1px;
}
.fc .fc-button-primary{
    background-color: #ffffff;
    color: #000000;
    border: 0;
}
.fc .fc-button-primary:disabled{
    background-color: #057af0;
    color: #FFFFFF;
    opacity: 1;
    border: 0;
}
.fc .fc-button-group >.fc-button.fc-button-active{
    background-color: #057af0;
    color: #FFFFFF;
    border: 0;
}
.fc .fc-button:focus, .fc .fc-button-primary:focus{
    box-shadow: transparent 0px 0px 0px 0px !important;
    -webkit-focus-ring-color: auto 0px !important;
}
</style>
