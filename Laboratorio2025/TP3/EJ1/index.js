const isUpperCase = (char) => /[A-Z]/.test(char);
const isLowerCase = (char) => /[a-z]/.test(char);

const analyzeCase = (str) => {
    const chars = str.replace(/ /g, '').split('');
    const hasUpper = chars.some(isUpperCase);
    const hasLower = chars.some(isLowerCase);
    return {
        isOnlyUppercase: hasUpper && !hasLower,
        isOnlyLowerCase: hasLower && !hasUpper,
        isMixedCase: hasUpper && hasLower,
    };
};

function main() {
    const strs = ['Hola mundo', 'HOLA MUNDO', 'hola mundo', 'HOLA MUNDO', 'Hola Mundo'];
    for (let str of strs) {
        const { isOnlyUppercase, isOnlyLowerCase, isMixedCase } = analyzeCase(str);
        if (isOnlyUppercase) {
            console.log(`"${str}" tiene solo mayusculas`);
        }
        if (isOnlyLowerCase) {
            console.log(`"${str}" tiene solo minusculas`);
        }
        if (isMixedCase) {
            console.log(`"${str}" es mezcla`);
        }
    }
};
main();