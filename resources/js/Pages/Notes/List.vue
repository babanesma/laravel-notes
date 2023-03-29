<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";

defineProps({
    notes: Object
});


const formDelete = useForm({})
function deleteNote(id: string) {
    if (confirm('Are you sure you want to delete this note ?')) {
        formDelete.delete(route('notes.destroy', id));
    }
}

</script>

<template>
    <Head title="Notes" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div class="title">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Notes</h2>
                </div>
                <div class="button-container">
                    <button class="btn btn-primary ml-2">
                        <Link :href="route('notes.create')">New Note</Link>
                    </button>
                </div>
            </div>
        </template>

        <div class="max-w-7xl mx-auto">
            <table class="table table-auto w-full m-2 p-2">
                <thead class="table-head">
                    <tr class="text-black font-semibold">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="note in notes" :key="note.id" :id="`row-${note.id}`">
                        <td>{{ note.id }}</td>
                        <td>{{ note.title }}</td>
                        <td>{{ note.description }}</td>
                        <td>
                            <div class="flex justify-start">
                                <div class="edit-btn w-6 mr-4">
                                    <Link :href="route('notes.edit', {note: note.id})" >
                                        <PencilSquareIcon class="w-6 h-6 text-green-600" />
                                    </Link>
                                </div>
                                <div class="delete-btn w-6 mr-4">
                                    <TrashIcon @click="deleteNote(note.id)" class="w-6 h-6 text-red-600 flex-1 cursor-pointer" />
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
