export class User {
    constructor({
        id_user,
        username,
        password,
        email
    }) {
        this.idUser = id_user;
        this.username = username;
        this.password = password;
        this.email = email;
    }
}