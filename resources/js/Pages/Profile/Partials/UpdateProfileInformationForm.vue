<script setup>
import { useForm } from '@inertiajs/vue3';

import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import InputError from '@/Components/Forms/InputError.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
});

const submit = () => {
    form.patch(route('profile.update'));
};
</script>

<template>
    <section>

        <header>
            <h2 class="text-lg font-medium text-ctext">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-muted">
                Update your account information.
            </p>
        </header>

        <form
            @submit.prevent="submit"
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    autocomplete="name"
                    v-model="form.name"
                    type="text"
                />
                <InputError
                    v-if="form.errors.name"
                    :message="form.errors.name"
                    class="mt-2"
                />
            </div>

            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    autocomplete="email"
                    v-model="form.email"
                    type="email"
                />
                <InputError
                    v-if="form.errors.email"
                    :message="form.errors.email"
                    class="mt-2"
                />
            </div>

            <PrimaryButton
                type="submit"
                :disabled="form.processing"
            >
                Save Changes
            </PrimaryButton>
        </form>
    </section>
</template>