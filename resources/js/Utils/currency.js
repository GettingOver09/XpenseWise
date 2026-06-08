const moneyFormatter = new Intl.NumberFormat("en-PH", {
    style: "currency",
    currency: "PHP",
    maximumFractionDigits: 0,
});

export const formatMoney = (amount) => {
    return moneyFormatter.format(amount);
};
