<script setup>
import { computed, ref, watch } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
} from "@headlessui/vue";

const props = defineProps({
    accounts: {
        type: Array,
        default: () => [],
    },
    categories: {
        type: Array,
        default: () => [],
    },
    types: {
        type: Array,
        default: () => ["Income", "Expense", "Transfer"],
    },
});

const validAccounts = computed(() =>
    props.accounts.filter((item) => item !== "All accounts"),
);

const defaultPrimaryAccount = validAccounts.value[0] ?? props.accounts[0] ?? "";
const defaultSecondaryAccount =
    validAccounts.value.find((item) => item !== defaultPrimaryAccount) ??
    props.accounts[0] ??
    "";

const transactionTypeOptions = computed(() => {
    const types = props.types.length
        ? props.types
        : ["All", "Income", "Expense", "Transfer"];

    return types.filter((type) => type !== "All");
});

const showCreateModal = ref(false);
const transactionType = ref("Income");
const transactionTypeIndex = computed({
    get: () =>
        Math.max(
            0,
            transactionTypeOptions.value.indexOf(transactionType.value),
        ),
    set: (value) => {
        const nextType = transactionTypeOptions.value[value];
        if (nextType) {
            transactionType.value = nextType;
        }
    },
});

const account = ref(defaultPrimaryAccount);
const fromAccount = ref(defaultPrimaryAccount);
const toAccount = ref(defaultSecondaryAccount);
const category = ref(props.categories[0] ?? "");
const counterparty = ref("");
const amount = ref("");
const description = ref("");
const transactionDate = ref("");
const receiptName = ref("");
const fileInput = ref(null);

const showTransferPanel = computed(() => transactionType.value === "Transfer");

const validToAccounts = computed(() =>
    validAccounts.value.filter((item) => item !== fromAccount.value),
);

const transferAccountsValid = computed(
    () =>
        !showTransferPanel.value ||
        (fromAccount.value &&
            toAccount.value &&
            fromAccount.value !== toAccount.value),
);

watch(
    [transactionType, fromAccount],
    () => {
        if (showTransferPanel.value && fromAccount.value === toAccount.value) {
            toAccount.value =
                validAccounts.value.find(
                    (item) => item !== fromAccount.value,
                ) ?? "";
        }

        if (
            transactionType.value !== "Transfer" &&
            !validAccounts.value.includes(account.value)
        ) {
            account.value = validAccounts.value[0] ?? "";
        }
    },
    { immediate: true },
);

const resetForm = () => {
    transactionType.value = transactionTypeOptions.value[0] ?? "Income";
    account.value = defaultPrimaryAccount;
    fromAccount.value = defaultPrimaryAccount;
    toAccount.value = defaultSecondaryAccount;
    category.value = props.categories[0] ?? "";
    counterparty.value = "";
    amount.value = "";
    description.value = "";
    transactionDate.value = "";
    receiptName.value = "";
    if (fileInput.value) {
        fileInput.value.value = "";
    }
};

const openCreateModal = () => {
    resetForm();
    showCreateModal.value = true;
};

const closeCreateModal = () => {
    showCreateModal.value = false;
};

const openReceiptPicker = () => {
    fileInput.value?.click();
};

const handleReceiptSelected = (event) => {
    const file = event.target.files?.[0];
    if (file) {
        receiptName.value = file.name;
    }
};

const submitTransaction = () => {
    if (!transferAccountsValid.value) {
        return;
    }

    const payload = {
        transactionType: transactionType.value,
        amount: amount.value,
        transactionDate: transactionDate.value,
        description: description.value,
    };

    if (showTransferPanel.value) {
        payload.fromAccount = fromAccount.value;
        payload.toAccount = toAccount.value;
    } else {
        payload.account = account.value;
        payload.category = category.value;
        payload.counterparty = counterparty.value;
    }

    console.log("Create transaction", payload);
    closeCreateModal();
};
</script>

<template>
    <div
        class="flex flex-col gap-2 sm:items-end sm:justify-end sm:flex-row sm:gap-3"
    >
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
            <button
                type="button"
                @click="openCreateModal"
                class="inline-flex items-center justify-center rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary/90"
            >
                Create Transaction
            </button>
            <button
                type="button"
                @click="openReceiptPicker"
                class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm font-semibold text-ctext transition hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800"
            >
                Scan Receipt
            </button>
        </div>

        <p v-if="receiptName" class="text-sm text-muted">
            Selected receipt: {{ receiptName }}
        </p>

        <input
            ref="fileInput"
            type="file"
            accept="image/*"
            class="hidden"
            @change="handleReceiptSelected"
        />

        <TransitionRoot as="template" :show="showCreateModal">
            <Dialog as="div" class="relative z-50" @close="closeCreateModal">
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm"
                    />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div
                        class="flex min-h-full items-center justify-center p-4 text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-out duration-300"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="ease-in duration-200"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel
                                class="w-full max-w-3xl transform overflow-hidden rounded-3xl border border-gray-200 bg-background p-6 text-left shadow-xl transition-all dark:border-gray-700"
                            >
                                <div
                                    class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between"
                                >
                                    <div>
                                        <DialogTitle
                                            class="text-lg font-semibold text-ctext"
                                        >
                                            Create Transaction
                                        </DialogTitle>
                                        <p class="mt-1 text-sm text-muted">
                                            Add a new transaction to your
                                            records.
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <TabGroup
                                        :selected-index="transactionTypeIndex"
                                        @change="transactionTypeIndex = $event"
                                    >
                                        <div
                                            class="rounded-3xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900"
                                        >
                                            <TabList
                                                class="flex flex-wrap gap-2 rounded-2xl bg-white p-1 text-sm shadow-sm dark:bg-gray-800"
                                            >
                                                <Tab
                                                    v-for="type in transactionTypeOptions"
                                                    :key="type"
                                                    v-slot="{ selected }"
                                                    as="template"
                                                >
                                                    <button
                                                        :class="[
                                                            'flex-1 rounded-2xl px-4 py-2 font-semibold transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-gray-900',
                                                            selected
                                                                ? 'bg-background text-primary shadow-sm'
                                                                : 'text-muted hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-gray-700',
                                                        ]"
                                                    >
                                                        {{ type }}
                                                    </button>
                                                </Tab>
                                            </TabList>

                                            <p class="mt-3 text-sm text-muted">
                                                Choose the transaction type to
                                                reveal only the fields you need.
                                            </p>

                                            <TabPanels class="mt-6">
                                                <TabPanel>
                                                    <div
                                                        class="grid gap-4 lg:grid-cols-2"
                                                    >
                                                        <div>
                                                            <label
                                                                class="text-sm font-semibold text-ctext"
                                                            >
                                                                Account
                                                            </label>
                                                            <select
                                                                v-model="
                                                                    account
                                                                "
                                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                            >
                                                                <option
                                                                    v-for="accountOption in validAccounts"
                                                                    :key="
                                                                        accountOption
                                                                    "
                                                                    :value="
                                                                        accountOption
                                                                    "
                                                                >
                                                                    {{
                                                                        accountOption
                                                                    }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="text-sm font-semibold text-ctext"
                                                            >
                                                                Income Category
                                                            </label>
                                                            <select
                                                                v-model="
                                                                    category
                                                                "
                                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                            >
                                                                <option
                                                                    v-for="categoryOption in props.categories"
                                                                    :key="
                                                                        categoryOption
                                                                    "
                                                                    :value="
                                                                        categoryOption
                                                                    "
                                                                >
                                                                    {{
                                                                        categoryOption
                                                                    }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="lg:col-span-2"
                                                        >
                                                            <label
                                                                class="text-sm font-semibold text-ctext"
                                                            >
                                                                Received From
                                                            </label>
                                                            <input
                                                                type="text"
                                                                v-model="
                                                                    counterparty
                                                                "
                                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                                placeholder="Source of funds"
                                                            />
                                                        </div>
                                                    </div>
                                                </TabPanel>

                                                <TabPanel>
                                                    <div
                                                        class="grid gap-4 lg:grid-cols-2"
                                                    >
                                                        <div>
                                                            <label
                                                                class="text-sm font-semibold text-ctext"
                                                            >
                                                                Account
                                                            </label>
                                                            <select
                                                                v-model="
                                                                    account
                                                                "
                                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                            >
                                                                <option
                                                                    v-for="accountOption in validAccounts"
                                                                    :key="
                                                                        accountOption
                                                                    "
                                                                    :value="
                                                                        accountOption
                                                                    "
                                                                >
                                                                    {{
                                                                        accountOption
                                                                    }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="text-sm font-semibold text-ctext"
                                                            >
                                                                Expense Category
                                                            </label>
                                                            <select
                                                                v-model="
                                                                    category
                                                                "
                                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                            >
                                                                <option
                                                                    v-for="categoryOption in props.categories"
                                                                    :key="
                                                                        categoryOption
                                                                    "
                                                                    :value="
                                                                        categoryOption
                                                                    "
                                                                >
                                                                    {{
                                                                        categoryOption
                                                                    }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="lg:col-span-2"
                                                        >
                                                            <label
                                                                class="text-sm font-semibold text-ctext"
                                                            >
                                                                Merchant
                                                            </label>
                                                            <input
                                                                type="text"
                                                                v-model="
                                                                    counterparty
                                                                "
                                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                                placeholder="Merchant name"
                                                            />
                                                        </div>
                                                    </div>
                                                </TabPanel>

                                                <TabPanel>
                                                    <div
                                                        class="grid gap-4 lg:grid-cols-2"
                                                    >
                                                        <div>
                                                            <label
                                                                class="text-sm font-semibold text-ctext"
                                                            >
                                                                From Account
                                                            </label>
                                                            <select
                                                                v-model="
                                                                    fromAccount
                                                                "
                                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                            >
                                                                <option
                                                                    v-for="accountOption in validAccounts"
                                                                    :key="
                                                                        accountOption
                                                                    "
                                                                    :value="
                                                                        accountOption
                                                                    "
                                                                >
                                                                    {{
                                                                        accountOption
                                                                    }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="text-sm font-semibold text-ctext"
                                                            >
                                                                To Account
                                                            </label>
                                                            <select
                                                                v-model="
                                                                    toAccount
                                                                "
                                                                :disabled="
                                                                    validToAccounts.length ===
                                                                    0
                                                                "
                                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary disabled:cursor-not-allowed disabled:opacity-60 dark:border-gray-700"
                                                            >
                                                                <option
                                                                    value=""
                                                                    disabled
                                                                >
                                                                    Select
                                                                    account
                                                                </option>
                                                                <option
                                                                    v-for="accountOption in validToAccounts"
                                                                    :key="
                                                                        accountOption
                                                                    "
                                                                    :value="
                                                                        accountOption
                                                                    "
                                                                >
                                                                    {{
                                                                        accountOption
                                                                    }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="lg:col-span-2 rounded-3xl border border-gray-200 bg-white p-4 text-sm text-muted dark:border-gray-700 dark:bg-gray-950"
                                                        >
                                                            <div
                                                                class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
                                                            >
                                                                <div>
                                                                    <p
                                                                        class="font-semibold text-ctext"
                                                                    >
                                                                        Transfer
                                                                        money
                                                                        between
                                                                        accounts
                                                                    </p>
                                                                    <p
                                                                        class="mt-1 text-sm text-muted"
                                                                    >
                                                                        Keep the
                                                                        source
                                                                        and
                                                                        destination
                                                                        accounts
                                                                        separate
                                                                        for a
                                                                        clean
                                                                        transfer.
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary"
                                                                >
                                                                    <span
                                                                        >↔</span
                                                                    >
                                                                    Moving funds
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            v-if="
                                                                !transferAccountsValid
                                                            "
                                                            class="lg:col-span-2 rounded-2xl border border-rose-300 bg-rose-50 px-4 py-3 text-sm text-rose-700 dark:border-rose-800 dark:bg-rose-950 dark:text-rose-200"
                                                        >
                                                            The destination
                                                            account must be
                                                            different from the
                                                            source account.
                                                        </div>
                                                    </div>
                                                </TabPanel>
                                            </TabPanels>
                                        </div>
                                    </TabGroup>

                                    <div class="mt-6 grid gap-4 lg:grid-cols-2">
                                        <div>
                                            <label
                                                class="text-sm font-semibold text-ctext"
                                            >
                                                Amount
                                            </label>
                                            <input
                                                type="number"
                                                v-model="amount"
                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                placeholder="0.00"
                                            />
                                        </div>
                                        <div>
                                            <label
                                                class="text-sm font-semibold text-ctext"
                                            >
                                                Date
                                            </label>
                                            <input
                                                type="date"
                                                v-model="transactionDate"
                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                            />
                                        </div>
                                        <div class="lg:col-span-2">
                                            <label
                                                class="text-sm font-semibold text-ctext"
                                            >
                                                Description
                                            </label>
                                            <textarea
                                                v-model="description"
                                                rows="2"
                                                class="mt-2 w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm text-ctext shadow-sm focus:border-primary focus:ring-primary dark:border-gray-700"
                                                placeholder="Describe the transaction"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end"
                                >
                                    <button
                                        type="button"
                                        class="w-full rounded-lg border border-gray-200 bg-background px-4 py-2 text-sm font-semibold text-ctext transition hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800 sm:w-auto"
                                        @click="closeCreateModal"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="button"
                                        :disabled="!transferAccountsValid"
                                        class="w-full rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white transition sm:w-auto"
                                        :class="{
                                            'cursor-not-allowed bg-primary/60 hover:bg-primary/60':
                                                !transferAccountsValid,
                                            'hover:bg-primary/90':
                                                transferAccountsValid,
                                        }"
                                        @click="submitTransaction"
                                    >
                                        Save Transaction
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>
