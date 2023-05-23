function showRegister() {
    let form = document.querySelector(".form-register");
    form.action = "/user/register";
    let subTitle = document.querySelector(".subtitle");
    subTitle.innerText = "Регистрация";
    let ps = form.querySelectorAll("p");
    let inputs = form.querySelectorAll("input");
    let button = form.querySelector("button");
    let divBlockButtons = document.querySelector(".block__submit");
    divBlockButtons.remove();
    button.remove();
    for (let block of [...ps, ...inputs]) {
        block.remove();
    }

    let dataAll = [
        {
            id: "secondName",
            label: "Фамилия",
            name: "second_name",
            type: "text"
        },
        {
            id: "firstName",
            label: "Имя",
            name: "first_name",
            type: "text"
        },
        {
            id: "email",
            label: "Email",
            name: "email",
            type: "text"
        },
        {
            id: "phone",
            label: "Телефон",
            name: "phone",
            type: "text"
        },
        {
            id: "avatarImg",
            label: "Аватар",
            name: "avatar_path",
            type: "file"
        }
    ];

    for (let data of dataAll) {
        let pLabel = document.createElement("p");
        pLabel.id = data.id;
        pLabel.innerText = data.label;
        pLabel.classList.add("labels");

        let input = document.createElement("input");
        input.type = data.type;
        input.name = data.name;
        if (data.type === "file") {
            input.accept = "image/jpeg, image/png";
        } else {
            input.classList.add("input__size");
        }

        form.appendChild(pLabel);
        form.appendChild(input);
    }

    let buttonLogIn = document.createElement("button");
    buttonLogIn.innerText = "Войти";
    buttonLogIn.classList.add("submit");
    buttonLogIn.setAttribute("onclick", "showAuth()");

    let inputSingIn = document.createElement("input");
    inputSingIn.value = "Зарегистрироваться";
    inputSingIn.type = "submit"
    inputSingIn.classList.add("submit");

    divBlockButtons = document.createElement("div");
    divBlockButtons.classList.add("block__submit");
    divBlockButtons.appendChild(buttonLogIn);
    divBlockButtons.appendChild(inputSingIn);
    form.appendChild(divBlockButtons);
}

function showAuth() {
    let form = document.querySelector(".form-register");
    form.action = "/user/auth";
    let subTitle = document.querySelector(".subtitle");
    subTitle.innerText = "Вход";
    let ps = form.querySelectorAll("p");
    let inputs = form.querySelectorAll("input");
    let button = form.querySelector("button");
    button.remove();
    for (let block of [...ps, ...inputs]) {
        if ((block.innerText !== "Телефон" && block.innerText !== "Email") &&
                (block.name !== "email" && block.name !== "phone")) {
            block.remove();
        }
    }

    let buttonLogIn = document.createElement("button");
    buttonLogIn.innerText = "Регистрироваться";
    buttonLogIn.classList.add("submit");
    buttonLogIn.setAttribute("onclick", "showRegister()");

    let inputSingIn = document.createElement("input");
    inputSingIn.value = "Войти";
    inputSingIn.type = "submit"
    inputSingIn.classList.add("submit");

    let divBlockButtons = document.querySelector(".block__submit");
    divBlockButtons.appendChild(buttonLogIn);
    divBlockButtons.appendChild(inputSingIn);
}