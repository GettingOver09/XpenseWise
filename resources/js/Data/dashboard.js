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

export const netWorthTrend = {
    "1D": [240000, 241000, 242000, 243000],
    "1W": [220000, 225000, 228000, 232000, 235000, 240000, 243000],
    "1M": [180000, 190000, 200000, 210000],
    "6M": [120000, 140000, 170000, 190000, 220000, 243000],
    "1Y": [
        90000, 100000, 110000, 130000, 145000, 160000, 175000, 190000, 205000,
        220000, 235000, 243000,
    ],
};

export const expenseBreakdown = {
    "1D": [
        { label: "Food", value: 140 },
        { label: "Bills", value: 0 },
        { label: "Transport", value: 25 },
        { label: "Shopping", value: 15 },
        { label: "Subscriptions", value: 0 },
    ],

    "1W": [
        { label: "Food", value: 980 },
        { label: "Bills", value: 450 },
        { label: "Transport", value: 180 },
        { label: "Shopping", value: 320 },
        { label: "Subscriptions", value: 40 },
    ],

    "1M": [
        { label: "Food", value: 4200 },
        { label: "Bills", value: 3100 },
        { label: "Transport", value: 1850 },
        { label: "Shopping", value: 2100 },
        { label: "Subscriptions", value: 1230 },
    ],

    "6M": [
        { label: "Food", value: 24200 },
        { label: "Bills", value: 18600 },
        { label: "Transport", value: 10400 },
        { label: "Shopping", value: 12100 },
        { label: "Subscriptions", value: 7380 },
    ],

    "1Y": [
        { label: "Food", value: 49400 },
        { label: "Bills", value: 37200 },
        { label: "Transport", value: 21600 },
        { label: "Shopping", value: 24500 },
        { label: "Subscriptions", value: 14760 },
    ],
};

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
