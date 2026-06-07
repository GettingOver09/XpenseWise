import {
    DashboardSquare02Icon,
    Invoice01Icon,
    PiggyBankIcon,
    ParagraphBulletsPoint01Icon,
    UserAccountIcon,
    Settings01Icon,
    UserIcon,
    HelpCircleIcon,
    ChatQuestion01Icon,
    CircleArrowLeft02Icon,
} from "@/Components/Icons";

export default {
    main: [
        {
            label: "Dashboard",
            route: "dashboard",
            icon: DashboardSquare02Icon,
        },
        {
            label: "Transactions",
            route: "transactions",
            icon: Invoice01Icon,
        },
        {
            label: "Budgets",
            route: "budgets",
            icon: PiggyBankIcon,
        },
        {
            label: "Categories",
            route: "categories",
            icon: ParagraphBulletsPoint01Icon,
        },
        {
            label: "Accounts",
            route: "accounts",
            icon: UserAccountIcon,
        },
    ],

    secondary: [
        {
            label: "Settings",
            route: "settings",
            icon: Settings01Icon,
        },
        {
            label: "FAQ",
            route: "faq",
            icon: HelpCircleIcon,
        },
        {
            label: "Contact Us",
            route: "about",
            icon: ChatQuestion01Icon,
        },
    ],
};
