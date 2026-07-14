import { computed } from "vue";

export function useTransactions({
    transactions,
    transactionsPeriod,
    transactionTypeIndex,
    selectedAccount,
    searchQuery,
    selectedCategories,
    selectedDateFrom,
    selectedDateTo,
}) {
    const periodOptions = [
        { label: "Last Month", value: "1M" },
        { label: "Last 3 Months", value: "3M" },
        { label: "Last 6 Months", value: "6M" },
        { label: "This Year", value: "1Y" },
        { label: "All Time", value: "all" },
    ];

    const transactionTypes = ["Income", "Expense", "Transfer"];
    const viewTabs = ["List", "Activity"];

    const categories = computed(() => {
        const uniqueCategories = new Set();

        transactions.value.forEach((transaction) => {
            if (transaction.category) {
                uniqueCategories.add(transaction.category);
            }
        });

        return Array.from(uniqueCategories).sort();
    });

    const accounts = computed(() => {
        const uniqueAccounts = new Set(["All accounts"]);

        transactions.value.forEach((transaction) => {
            if (transaction.account) {
                uniqueAccounts.add(transaction.account);
            }
        });

        return Array.from(uniqueAccounts);
    });

    const selectedType = computed(
        () => transactionTypes[transactionTypeIndex.value],
    );

    const selectedPeriodLabel = computed(() => {
        return periodOptions.find(
            (option) => option.value === transactionsPeriod.value,
        )?.label;
    });

    const filteredTransactions = computed(() => {
        const query = searchQuery.value.trim().toLowerCase();
        const dateFrom = selectedDateFrom.value
            ? new Date(selectedDateFrom.value)
            : null;
        const dateTo = selectedDateTo.value
            ? new Date(selectedDateTo.value)
            : null;

        return transactions.value.filter((transaction) => {
            const typeFilter = selectedType.value.toLowerCase();
            const matchesType = !typeFilter || transaction.type === typeFilter;

            const matchesAccount =
                selectedAccount.value === "All accounts" ||
                transaction.account === selectedAccount.value;

            const matchesCategories =
                !selectedCategories.value.length ||
                selectedCategories.value.includes(transaction.category);

            const matchesQuery =
                !query ||
                [
                    transaction.merchant,
                    transaction.category,
                    transaction.account,
                    transaction.note,
                ].some((field) => field.toLowerCase().includes(query));

            let matchesDate = true;
            if (transaction.transaction_date) {
                const transactionDate = new Date(transaction.transaction_date);

                if (dateFrom && transactionDate < dateFrom) {
                    matchesDate = false;
                }
                if (dateTo && transactionDate > dateTo) {
                    matchesDate = false;
                }
            }

            return (
                matchesType &&
                matchesAccount &&
                matchesCategories &&
                matchesQuery &&
                matchesDate
            );
        });
    });

    return {
        periodOptions,
        transactionTypes,
        viewTabs,
        accounts,
        categories,
        selectedType,
        selectedPeriodLabel,
        filteredTransactions,
    };
}
