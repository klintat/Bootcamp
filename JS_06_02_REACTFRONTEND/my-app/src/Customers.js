import React from 'react';

class Customers extends React.Component {

    constructor() {
        super();
        this.state = {
            customers: [],
            customersInit: [],
            editable: false,
            custToUpdate: []
        }
        this.customersInit();
    }

    customersInit = () => {
        let self = this;
        fetch("http://localhost/my-app-backend/customers.php", {
            method: "GET"
        }).then(function (response) {
            if (response.ok) {
                response.json().then(customers => {
                    self.setCustomerTable(customers);
                });
            }
        })
    }

    onChangeSave = () => {
        const custListUpdate = [];
        for (let i = 0; i < this.state.custToUpdate.length; i++) {
            if (this.state.custToUpdate[i] !== true)
                continue;
            const customerId = i;
            const customer = this.state.customers.find((customer) => {
                return customer.id === customerId;
            })
            custListUpdate.push(customer);
        }

        const headers = new Headers();
        headers.append("Content-type", "application/json");
        const self = this;
        fetch("http://localhost/my-app-backend/updateCustomer.php", {
            method: "POST",
            headers: headers,
            body: JSON.stringify(custListUpdate)
        }).then(function (response) {
            response.json().then((body) => {
                alert(body);
                const customersInit = this.state.customers;
                self.setCustomerTable(customersInit);
                self.setState({ custToUpdate: [] });
            })
        })

    }

    updateCustomer = (id, fieldname, value) => {
        const customers = this.state.customers;//copy the array
        const customerUpd = customers.find((customer) => {
            return customer.id === id;
        })
        customerUpd[fieldname] = value;
        const customersToUpdateIds = this.state.custToUpdate;
        customersToUpdateIds[id] = true;

        this.setState({ customers: customers, custToUpdate: customersToUpdateIds });
    }

    setCustomerTable(customersLoad) {
        const initCustomers = [];
        customersLoad.map((obj) => {
            initCustomers.push(Object.assign({}, obj));
        })
        this.setState({ customers: initCustomers, customersInit: customersLoad });
    }

    setEditable = () => {
        const editable = !this.state.editable;
        this.setState({ editable: editable });
    }

    onInputChange = (event, id) => {
        const fieldname = event.target.getAttribute("fieldname");
        const value = event.target.value;
        this.updateCustomer(id, fieldname, value);
    }

    onCancel = () => {
        const customers = this.state.customersInit;
        this.setCustomerTable(customers);
        this.setEditable();
    }

    render() {
        return (
            <form method='POST'>
                <button className='btn' type='button' onClick={this.setEditable}>
                    Edit
                </button>
                <button className='btn' onClick={this.onChangeSave} type="button">
                    Save
                </button>
                <button className='btn' onClick={this.onCancel} type="button">
                    Cancel
                </button>
                <table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>E-Mail</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        {
                            !(this.state.customers === undefined) && this.state.customers.map((customer) => {
                                return (
                                    <tr key={customer.id} onChange={
                                        (e) => this.onInputChange(e, customer.id)}>
                                        <td>
                                            <div hidden={this.state.editable}>
                                                {customer.firstname}
                                            </div>
                                            <input hidden={!this.state.editable}
                                                fieldname="firstname"
                                                value={customer.firstname}></input>
                                        </td>
                                        <td>
                                            <div hidden={this.state.editable}>
                                                {customer.lastname}
                                            </div>
                                            <input hidden={!this.state.editable}
                                                fieldname="lastname"
                                                value={customer.lastname}></input>
                                        </td>
                                        <td>
                                            <div hidden={this.state.editable}>
                                                {customer.email}
                                            </div>
                                            <input hidden={!this.state.editable}
                                                fieldname="email"
                                                value={customer.email}></input>
                                        </td>
                                        <td>
                                            <div hidden={this.state.editable}>
                                                {customer.phone}
                                            </div>
                                            <input hidden={!this.state.editable}
                                                fieldname="phone"
                                                value={customer.phone}></input>
                                        </td>
                                    </tr>
                                );
                            })
                        }
                    </tbody>
                </table>
            </form>
        );
    }

}

export default Customers;