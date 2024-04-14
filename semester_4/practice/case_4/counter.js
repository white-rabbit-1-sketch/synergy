document.addEventListener('DOMContentLoaded', function () {
    class Counter {
        constructor(
            minusButtonSelector,
            plusButtonSelector,
            valueContainerSelector,
            limitContainerSelector,
            negativeClass,
            positiveClass,
            zeroClass,
            minimumCounterValue,
            maximumCounterValue,
        ) {
            this._counter = 0;

            this.minusButton = document.getElementById(minusButtonSelector);
            this.plusButton = document.getElementById(plusButtonSelector);
            this.valueContainer = document.getElementById(valueContainerSelector);
            this.limitContainer = document.getElementById(limitContainerSelector);
            this.negativeClass = negativeClass;
            this.positiveClass = positiveClass;
            this.zeroClass = zeroClass;
            this.minimumCounterValue = minimumCounterValue;
            this.maximumCounterValue = maximumCounterValue;

            this.increment = this.increment.bind(this);
            this.decrement = this.decrement.bind(this);
            this.minusButton.addEventListener('click', this.decrement);
            this.plusButton.addEventListener('click', this.increment);
        }

        increment() {
            this.counter++;
        }

        decrement() {
            this.counter--;
        }

        get counter() {
            return this._counter;
        }

        set counter(value) {
            this._counter = value;

            this.showValue();
        }

        showValue() {
            this.valueContainer.textContent = `${this._counter}`;

            this.updateValueContainerColor();
            this.updateButtonsState();
            this.updateLimitState();
        }

        updateValueContainerColor() {
            this.valueContainer.classList.remove(this.negativeClass);
            this.valueContainer.classList.remove(this.positiveClass);
            this.valueContainer.classList.remove(this.zeroClass);

            if (this._counter < 0) {
                this.valueContainer.classList.add(this.negativeClass);
            } else if (this._counter > 0) {
                this.valueContainer.classList.add(this.positiveClass);
            } else  {
                this.valueContainer.classList.add(this.zeroClass);
            }
        }

        updateButtonsState() {
            this.minusButton.disabled = false;
            this.plusButton.disabled = false;

            if (this._counter <= this.minimumCounterValue) {
                this.minusButton.disabled = true;
            } else if (this.counter >= this.maximumCounterValue) {
                this.plusButton.disabled = true;
            }
        }

        updateLimitState() {
            this.limitContainer.style.visibility = 'hidden';

            if (
                this._counter <= this.minimumCounterValue ||
                this.counter >= this.maximumCounterValue
            ) {
                this.limitContainer.style.visibility = 'visible';
            }
        }
    }

    let counter = new Counter(
        'button-minus',
        'button-plus',
        'counter-value-container',
        'limit-container',
        'negative',
        'positive',
        'zero',
        -10,
        10
    );
});
