import { Oven } from './oven.mjs';

class AdvancedOven extends Oven {
    constructor(maxTemperature) {
        super(maxTemperature);
        this._currentTemperature = 0;
        this._heatingInterval = null;
    }

    turnOn() {
        console.log("Oven is on. Start heating...");

        this._heatingInterval = setInterval(() => {
            if (this._currentTemperature < this.maxTemperature) {
                this._currentTemperature += 1;
                console.log(`Temperature is: ${this._currentTemperature}`);
            } else {
                console.log("Oven was heated. Turning off...");
                this.turnOff();
            }
        }, 500);
    }

    turnOff() {
        console.log("Oven is off. Start cooling...");

        clearInterval(this._heatingInterval);

        const coolingInterval = setInterval(() => {
            if (this._currentTemperature > 0) {
                this._currentTemperature -= 1;
                console.log(`Temperature is: ${this._currentTemperature}`);
            } else {
                console.log("Oven was cooled. End of work.");
                clearInterval(coolingInterval);
            }
        }, 500);
    }
}

export { AdvancedOven };