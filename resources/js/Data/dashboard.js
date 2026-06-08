import { formatMoney } from "@/Utils/currency";

export const summaryCards = [
    {
        label: "Total Balance",
        value: formatMoney(48250),
        helper: "+8.4% from last month",
        tone: "text-emerald-600 dark:text-emerald-400",
    },
    {
        label: "This Month Income",
        value: formatMoney(32800),
        helper: "3 income entries",
        tone: "text-sky-600 dark:text-sky-400",
    },
    {
        label: "This Month Expenses",
        value: formatMoney(12480),
        helper: "42% of income spent",
        tone: "text-rose-600 dark:text-rose-400",
    },
];

export const netWorthTrend = [
    28500, 30250, 31800, 33600, 35150, 37700, 39400, 42100, 43800, 45200, 46850,
    48250,
];

export const expenseBreakdown = [
    { label: "Food", value: 4200 },
    { label: "Bills", value: 3100 },
    { label: "Transport", value: 1850 },
    { label: "Shopping", value: 2100 },
    { label: "Subscriptions", value: 1230 },
];

export const accounts = [
    { name: "BDO Savings", balance: 22800 },
    { name: "GCash", balance: 8100 },
    { name: "Maya Wallet", balance: 6350 },
    { name: "Emergency Fund", balance: 11000 },
];

export const budgets = [
    { name: "Groceries", used: 6800, limit: 10000 },
    { name: "Dining Out", used: 3600, limit: 5000 },
    { name: "Transport", used: 1900, limit: 3000 },
    { name: "Entertainment", used: 2600, limit: 4000 },
];

export const recentTransactions = [
    {
        date: "Jun 8",
        merchant: "Salary",
        category: "Income",
        account: "BDO Savings",
        amount: 28000,
        type: "income",
    },
    {
        date: "Jun 7",
        merchant: "Meralco",
        category: "Bills",
        account: "BDO Savings",
        amount: -2450,
        type: "expense",
    },
    {
        date: "Jun 6",
        merchant: "Grab",
        category: "Transport",
        account: "GCash",
        amount: -320,
        type: "expense",
    },
    {
        date: "Jun 5",
        merchant: "Landers",
        category: "Groceries",
        account: "Maya Wallet",
        amount: -3150,
        type: "expense",
    },
    {
        date: "Jun 4",
        merchant: "Freelance Project",
        category: "Income",
        account: "BDO Savings",
        amount: 4800,
        type: "income",
    },
];
