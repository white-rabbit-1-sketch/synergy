import { Oven } from './oven.mjs';
import { AdvancedOven } from './advanced-oven.mjs';
import { check } from './regexp-module.mjs';

const ovenInstance = new Oven(10);

console.log("Temperature is: " + ovenInstance.maxTemperature);

const advancedOvenInstance = new AdvancedOven(10);

console.log(`Maximum temperature is: ${advancedOvenInstance.maxTemperature}`);

advancedOvenInstance.turnOn();

console.log(check('Привет Javascript'));