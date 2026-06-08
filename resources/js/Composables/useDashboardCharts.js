import { formatMoney } from "@/Utils/currency";
import { computed } from "vue";

export function useDashboardCharts({
    netWorthTrend,
    expenseBreakdown,
    accounts,
    budgets,
    isDark,
    foreground,
    muted,
    grid,
}) {
    const chartBase = computed(() => ({
        chart: {
            toolbar: { show: false },
            zoom: { enabled: false },
            foreColor: muted.value,
            fontFamily: "Figtree, ui-sans-serif, system-ui, sans-serif",
        },
        dataLabels: { enabled: false },
        legend: {
            labels: { colors: muted.value },
        },
        tooltip: {
            theme: isDark.value ? "dark" : "light",
            y: {
                formatter: (value) => formatMoney(value),
            },
        },
    }));

    const netWorthOptions = computed(() => ({
        ...chartBase.value,
        chart: {
            ...chartBase.value.chart,
            sparkline: { enabled: false },
        },
        colors: ["#10b981"],
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.34,
                opacityTo: 0.04,
                stops: [0, 90, 100],
            },
        },
        grid: {
            borderColor: grid.value,
            strokeDashArray: 4,
        },
        stroke: {
            curve: "smooth",
            width: 3,
        },
        xaxis: {
            categories: [
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
            ],
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: { style: { colors: muted.value } },
        },
        yaxis: {
            labels: {
                formatter: (value) => `${Math.round(value / 1000)}k`,
                style: { colors: muted.value },
            },
        },
    }));

    const netWorthSeries = computed(() => [
        {
            name: "Net Worth",
            data: netWorthTrend,
        },
    ]);

    const expenseBreakdownOptions = computed(() => ({
        ...chartBase.value,
        labels: expenseBreakdown.map((item) => item.label),
        colors: ["#ef4444", "#f59e0b", "#06b6d4", "#8b5cf6", "#64748b"],
        plotOptions: {
            pie: {
                donut: {
                    size: "68%",
                    labels: {
                        show: true,
                        name: {
                            color: muted.value,
                        },
                        value: {
                            color: foreground.value,
                            formatter: (value) => formatMoney(value),
                        },
                        total: {
                            show: true,
                            label: "Expenses",
                            color: muted.value,
                            formatter: () =>
                                formatMoney(
                                    expenseBreakdown.reduce(
                                        (total, item) => total + item.value,
                                        0,
                                    ),
                                ),
                        },
                    },
                },
            },
        },
        stroke: {
            colors: [isDark.value ? "#1a202c" : "#ffffff"],
        },
    }));

    const expenseBreakdownSeries = computed(() =>
        expenseBreakdown.map((item) => item.value),
    );

    const accountsOptions = computed(() => ({
        ...chartBase.value,
        colors: ["#4f46e5"],
        grid: {
            borderColor: grid.value,
            strokeDashArray: 4,
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: "54%",
                borderRadius: 5,
                distributed: true,
            },
        },
        xaxis: {
            categories: accounts.map((item) => item.name),
            labels: {
                formatter: (value) => `${Math.round(value / 1000)}k`,
                style: { colors: muted.value },
            },
        },
        yaxis: {
            labels: {
                style: { colors: muted.value },
            },
        },
        legend: { show: false },
    }));

    const accountsSeries = computed(() => [
        {
            name: "Balance",
            data: accounts.map((item) => item.balance),
        },
    ]);

    const budgetUsageOptions = computed(() => ({
        ...chartBase.value,
        colors: ["#f59e0b"],
        grid: {
            borderColor: grid.value,
            strokeDashArray: 4,
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: "54%",
                borderRadius: 5,
            },
        },
        xaxis: {
            categories: budgets.map((item) => item.name),
            max: 100,
            labels: {
                formatter: (value) => `${value}%`,
                style: { colors: muted.value },
            },
        },
        yaxis: {
            labels: {
                style: { colors: muted.value },
            },
        },
        tooltip: {
            theme: isDark.value ? "dark" : "light",
            y: {
                formatter: (value, context) => {
                    const budget = budgets[context.dataPointIndex];

                    return `${value}% of ${formatMoney(budget.limit)}`;
                },
            },
        },
    }));

    const budgetUsageSeries = computed(() => [
        {
            name: "Used",
            data: budgets.map((item) =>
                Math.round((item.used / item.limit) * 100),
            ),
        },
    ]);

    return {
        netWorthOptions,
        netWorthSeries,
        expenseBreakdownOptions,
        expenseBreakdownSeries,
        accountsOptions,
        accountsSeries,
        budgetUsageOptions,
        budgetUsageSeries,
    };
}
