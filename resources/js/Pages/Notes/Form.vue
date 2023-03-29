<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    formTitle: String,
    isEdit: {
        type: Boolean,
        default: false
    },
    note: {
        type: Object,
        default: () => ({}),
    },
})

const form = useForm({
    title: props.isEdit ? props.note.title : null,
    description: props.isEdit ? props.note.description : null
})

function saveForm() {
    if (props.isEdit) {
        form.put(route('notes.update', props.note.id))
    } else {
        form.post(route('notes.store'))
    }
}

</script>


<template>
    <Head title="Notes" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div class="title">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ formTitle }}</h2>
                </div>
            </div>
        </template>

        <div class="max-w-6xl mx-auto w-96">
            <form @submit.prevent="saveForm">
                <div class="form-control">
                    <label for="title" class="label">
                        <span class="label-text text-xl">Title</span>
                        <span v-if="form.errors.title" class="label-text-alt text-error font-semibold text-lg title-error hidden"></span>
                    </label>
                    <input type="text" name="title" id="title" class="input input-bordered w-full" required v-model="form.title">
                </div>
                <div class="form-control">
                    <label for="description" class="label">
                        <span class="label-text text-xl">Description</span>
                        <span v-if="form.errors.description" class="label-text-alt text-error font-semibold text-lg description-error hidden"></span>
                    </label>
                    <textarea class="textarea textarea-bordered h-24" placeholder="Description" required v-model="form.description"></textarea>
                </div>
                <div class="form-control mt-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
