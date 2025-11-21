const fs = require('fs');
const content = fs.readFileSync('assets/js/script.js', 'utf8');
const openBraces = (content.match(/\{/g) || []).length;
const closeBraces = (content.match(/\}/g) || []).length;
console.log(`Open braces: ${openBraces}`);
console.log(`Close braces: ${closeBraces}`);
console.log(`Difference: ${openBraces - closeBraces}`);

if (openBraces === closeBraces) {
  console.log('✓ Braces are balanced!');
} else {
  console.log('✗ Braces are NOT balanced!');
}

