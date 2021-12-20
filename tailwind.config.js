const INT2HEX = (int) => {
    const hex = Math.min(Math.max(Math.round(int), 0), 255).toString(16);
    return `${hex.length == 1 ? "0" : ""}${hex}`;
};

const HEX2RGB = (hex) => {
    hex = hex.replace("#", "");
    if (hex.length != 3 && hex.length != 6) return { r: 0, g: 0, b: 0 };
    const step = hex.length == 3 ? 1 : 2;
    const hexR = hex.substr(0, step),
        hexG = hex.substr(step, step),
        hexB = hex.substr(step * 2, step);
    return {
        r: parseInt((step == 1 ? hexR : "") + hexR, 16) || 0,
        g: parseInt((step == 1 ? hexG : "") + hexG, 16) || 0,
        b: parseInt((step == 1 ? hexB : "") + hexB, 16) || 0,
    };
};

const RGB2HEX = (rgb) => `${INT2HEX(rgb.r)}${INT2HEX(rgb.g)}${INT2HEX(rgb.b)}`;

const shade = (rgb, step) => ({
    r: rgb.r * (1 - 0.2 * step),
    g: rgb.g * (1 - 0.2 * step),
    b: rgb.b * (1 - 0.2 * step),
});
const tint = (rgb, step) => ({
    r: rgb.r + (255 - rgb.r) * step * 0.2,
    g: rgb.g + (255 - rgb.g) * step * 0.2,
    b: rgb.b + (255 - rgb.b) * step * 0.2,
});

const generate = (hex, callback) => {
    const rgb = HEX2RGB(hex);
    const variations = [];
    for (let i = 1; i < 5; i++) variations.push(RGB2HEX(callback(rgb, i)));
    return variations;
};

const map = (hex) => {
    const hexes = [
        ...generate(hex, tint).reverse(),
        RGB2HEX(HEX2RGB(hex)),
        ...generate(hex, shade),
    ];
    const variations = {};
    hexes?.forEach((a, i) => {
        variations[(i + 1) * 100] = `#${a}`;
    });
    return variations;
};

const create = (colors) => {
    const variations = {};
    for (let name in colors) {
        const hex = colors[name];
        variations[name] = map(hex);
    }
    return variations;
};

module.exports = {
    theme: {
        extend: {
            colors: {
                ...create({
                    primary: "98826b",
                    secondary: "4ba6a6",
                    ternary: "ffd04d",
                    quaternary: "3b1f2b",
                    quinary: "352d39",
                    brand: "1f5",
                }),
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
};
