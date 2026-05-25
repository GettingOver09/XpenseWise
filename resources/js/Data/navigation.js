import {
    ChatQuestion01Icon,
    CircleArrowLeft02Icon,
    DashboardSquare02Icon,
    HelpCircleIcon,
    Invoice01Icon,
    ParagraphBulletsPoint01Icon,
    PiggyBankIcon,
    Settings01Icon,
    SmartIcon,
    UserAccountIcon,
    UserIcon,
} from '@/Components/Icons';

export default [
    {
        label: "Dashboard",
        href: "/dashboard",
        icon: DashboardSquare02Icon,
    },
    {
        label: "Transactions",
        icon: Invoice01Icon,
    },
    {
        label: "Budgets",
        icon: PiggyBankIcon,
    },
    {
        label: "Categories",
        icon: ParagraphBulletsPoint01Icon,
    },
    {
        label: "Accounts",
        icon: UserAccountIcon,
    },
    {
        label: "About",
        href: "/about",
        icon: SmartIcon,
    },
    {
        label: "Profile",
        href: "/profile",
        icon: UserIcon,
    },
    {
        label: "Settings",
        icon: Settings01Icon,
        spacerBefore: true,
    },
    {
        label: "FAQ",
        icon: HelpCircleIcon,
    },
    {
        label: "Contact Us",
        icon: ChatQuestion01Icon,
    },
    {
        label: "Collapse",
        icon: CircleArrowLeft02Icon,
    },
];
