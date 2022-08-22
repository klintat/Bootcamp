import React from 'react';

class InputCustomer extends React.Component {

    constructor() {
        super();
        this.state = {
            firstname: "",
            lastname: "",
            email: "",
            phone: ""
        }
    }

    onSave = (event) => {
        let self = this;
        const headers = new Headers();
        headers.append("Content-type", "application/json");
        fetch("http://localhost/my-app-backend/createCustomer.php", {
            method: "POST",
            headers: headers,
            body: JSON.stringify(self.state)
        }).then(function (response) {
            response.json().then((body) => {
                alert(body);
            })
        })
    }

    onNameChange = (event) => {
        this.setState({ firstname: event.target.value });
    }

    onLastNamechange = (event) => {
        this.setState({ lastname: event.target.value });
    }

    onEmailChange = (event) => {
        this.setState({ email: event.target.value });
    }

    onPhoneChange = (event) => {
        this.setState({ phone: event.target.value });
    }
    render() {
        return (
            <form onSubmit={this.onSave}>
                <div className="form-group">
                    <label htmlFor="firstname">First Name</label>
                    <input id="firstname"
                        fieldname="firstname" value={this.state.firstname}
                        onChange={this.onNameChange}></input>
                    <label htmlFor="lastname">Last Name</label>
                    <input id="lastname"
                        fieldname="lastname" value={this.state.lastname}
                        onChange={this.onLastNamechange}></input>

                    <label htmlFor="email">E-Mail</label>
                    <input id="email"
                        fieldname="email" value={this.state.email}
                        onChange={this.onEmailChange}></input>

                    <label htmlFor="phone">Phone</label>
                    <input id="phone"
                        fieldname="phone" value={this.state.phone}
                        onChange={this.onPhoneChange}></input>
                    <button className="btn btn-primary">Save</button>
                </div>
            </form>
        );
    }
}

export default InputCustomer;