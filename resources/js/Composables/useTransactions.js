import { computed } from "vue";

export function useTransactions({
    transactions,
    transactionsPeriod,
    transactionTypeIndex,
    selectedAccount,
    searchQuery,
}) {
    const periodOptions = [
        { label: "Last Month", value: "1M" },
        { label: "Last 3 Months", value: "3M" },
        { label: "Last 6 Months", value: "6M" },
        { label: "This Year", value: "1Y" },
        { label: "All Time", value: "all" },
    ];

    const transactionTypes = ["All", "Income", "Expenses"];
    const viewTabs = ["List", "Activity"];
    const accounts = ["All accounts", "BDO Savings", "GCash", "Maya Wallet"];

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

        return transactions.value.filter((transaction) => {
            const matchesType =
                selectedType.value === "All" ||
                transaction.type ===
                    selectedType.value
                        .toLowerCase()
                        .replace("expenses", "expense");

            const matchesAccount =
                selectedAccount.value === "All accounts" ||
                transaction.account === selectedAccount.value;

            const matchesQuery =
                !query ||
                [
                    transaction.merchant,
                    transaction.category,
                    transaction.account,
                    transaction.note,
                ].some((field) => field.toLowerCase().includes(query));

            return matchesType && matchesAccount && matchesQuery;
        });
    });

    return {
        periodOptions,
        transactionTypes,
        viewTabs,
        accounts,
        selectedType,
        selectedPeriodLabel,
        filteredTransactions,
    };
}
