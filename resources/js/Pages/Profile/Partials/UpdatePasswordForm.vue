<script setup>
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import InputError from '@/Components/Forms/InputError.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.put(route('password.update'), {
        onSuccess: () => form.reset(),
    });
};

const page = usePage();

</script>

<template>
    <section>

        <header>
            <h2 class="text-lg font-medium text-ctext">
                Update Password
            </h2>

            <p class="mt-1 text-sm text-muted">
                Ensure your account uses a secure password.
            </p>
        </header>

        <form
            @submit.prevent="submit"
            class="mt-6 space-y-6"
        >

            <div>
                <InputLabel for="current_password" value="Current Password" />
                <TextInput
                    id="current_password"
                    v-model="form.current_password"
                    type="password" 
                    autocomplete="current-password"
                />
                <InputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <div>
                <InputLabel for="password" value="New Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    autocomplete="new-password"
                    
                />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>
            
            <div>
                <InputLabel for="password_confirmation" value="Confirm New Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    autocomplete="new-password"
                />
                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <PrimaryButton
                type="submit"
                :disabled="form.processing"
            >
                Update Password
            </PrimaryButton>
        </form>
    </section>
</template>