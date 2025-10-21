document.addEventListener('DOMContentLoaded', function () {
    // 1
    const h1Element = document.createElement('h1');
    h1Element.textContent = 'Hello World !';
    document.body.append(h1Element);

// 2
    const olElement = document.createElement('ol');
    document.body.append(olElement);

    const employees = [
        { firstName: 'John', lastName: 'Doe' },
        { firstName: 'Jane', lastName: 'Smith' },
        { firstName: 'Bob', lastName: 'Johnson' },
        { firstName: 'Alice', lastName: 'Williams' },
        { firstName: 'Charlie', lastName: 'Brown' }
    ];

    for (const employee of employees) {
        const liElement = document.createElement('li');
        liElement.textContent = `${employee.firstName} ${employee.lastName}`;
        olElement.append(liElement);
    }

// 3
    const squareContainer = document.createElement('div');
    squareContainer.style.width = '50px';
    squareContainer.style.height = '50px';
    squareContainer.style.backgroundColor = 'red';
    squareContainer.style.transition = 'border-radius 0.5s'; // Плавность перехода
    document.body.append(squareContainer);

    squareContainer.addEventListener('click', () => {
        if (squareContainer.style.borderRadius === '50%') {
            squareContainer.style.borderRadius = '0%';
        } else {
            squareContainer.style.borderRadius = '50%';
        }
    });

// 4
    const calculator = {
        add: function (a, b) {
            return a + b;
        },
        subtract: function (a, b) {
            return a - b;
        },
        multiply: function (a, b) {
            return a * b;
        },
        divide: function (a, b) {
            if (b === 0) {
                return 'Cannot divide by zero';
            }
            return a / b;
        }
    };

    console.log(calculator.add(5, 3));
    console.log(calculator.subtract(8, 2));
    console.log(calculator.multiply(4, 6));
    console.log(calculator.divide(10, 2));

// 5
    const inputElement = document.createElement('input');
    const buttonElement = document.createElement('button');
    buttonElement.textContent = 'Сохранить';

    document.body.append(inputElement, buttonElement);

    buttonElement.addEventListener('click', () => {
        localStorage.setItem('Text', inputElement.value);

        setTimeout(() => {
            const savedText = localStorage.getItem('Text');
            console.log('Saved Text:', savedText);
        }, 2000);
    });

});

