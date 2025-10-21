class Oven {
    constructor(maxTemperature) {
        this._maxTemperature = maxTemperature;
    }

    get maxTemperature() {
        return this._maxTemperature;
    }

    set maxTemperature(value) {
        if (value <= 15) {
            this._maxTemperature = value;
        } else {
            console.log("Maximum temperature shouldn't be more than 15");
        }
    }
}

export { Oven };