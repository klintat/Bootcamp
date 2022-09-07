import React from 'react';

class Customers extends React.Component {

    constructor() {
        super();
        this.state = {
            csrf_token: "",
            customers: [],
            customersInit: [],
            editable: false,
            custToUpdate: [],
            numberOfPages: 0,
            currentPage: 1,
            customersShown: [],
            user: JSON.parse(sessionStorage.getItem("user"))
        }
    }

    setPageShown = () => {
        const startPos = (this.state.currentPage - 1) * 10;
        let endPosit = startPos + 10;
        if (endPosit + 1 > this.state.customers.length)
            endPosit = this.state.customers.length;

        const customersShown = [];
        for (let i = startPos; i < endPosit; i++)
            customersShown.push(this.state.customers[i]);
        this.setState({ customersShown: customersShown });
    }

    componentDidMount() {
        this.props.customersInit(this);
        this.setToken(this.props.csrf_token);
    }

    setToken = (token) => {
        this.setState({ csrf_token: token });
    }

    onChangeSave = () => {
        let custListUpdate = [];
        let link;
        if (this.props.allNew) {
            custListUpdate = this.state.customers;
            link = "http://localhost/my-app-backend/createCustomers.php"
        }
        else {
            for (let i = 0; i < this.state.custToUpdate.length; i++) {
                if (this.state.custToUpdate[i] !== true)
                    continue;
                const customerId = i;
                const customer = this.state.customers.find((customer) => {
                    return customer.id === customerId;
                })
                custListUpdate.push(customer);
            }
            link = "http://127.0.0.1:8000/customers-update";
        }
        const headers = new Headers();
        headers.append("Content-type", "application/json");
        headers.append("X-CSRF-TOKEN", this.state.csrf_token)
        const self = this;
        fetch(link, {
            method: "POST",
            headers: headers,
            body: JSON.stringify({ "customers": custListUpdate })
        }).then(function (response) {
            response.json().then((body) => {
                alert(body);
                const customersInit = self.state.customers;
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
        const pagesNo = Math.floor(customersLoad.length / 10);
        this.setState({
            customers: initCustomers,
            customersInit: customersLoad, numberOfPages: pagesNo
        }, this.setPageShown);
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

    switchPageEvent = (event) => {
        this.swtichPage(
            Number(event.target.innerHTML));
    }

    swtichPage = (pageNo) => {
        this.setState({ currentPage: pageNo });
        this.setPageShown();
    }

    nextPage = () => {
        this.swtichPage(++this.state.currentPage);
    }

    previousPage = () => {
        this.swtichPage(--this.state.currentPage);
    }

    generatePageItems = () => {
        const pagesArr = [];
        if (this.state.currentPage > 1)
            pagesArr.push(<li className="page-item" key={"prev"}>
                <button type='button' className="btn btn-primary"
                    onClick={this.previousPage}>Previous</button>
            </li>)
        for (let i = 1; i <= this.state.numberOfPages; i++) {
            pagesArr.push(<li className="page-item" key={i}>
                <button type='button' className={this.state.currentPage
                    === i ? "btn btn-primary" : "btn"}
                    onClick={this.switchPageEvent}>{i}</button>
            </li>);
        }
        if (this.state.currentPage < this.state.numberOfPages)
            pagesArr.push(<li className="page-item" key={"next"}>
                <button type='button' className="btn btn-primary"
                    onClick={this.nextPage}>Next</button>
            </li>)
        return pagesArr;
    }

    render() {
        return (
            <form method='POST'>
                <input name="_token" hidden value={this.state.csrf_token} />
                <nav aria-label="Page navigation example">
                    <ul className="pagination">
                        {this.generatePageItems()}
                    </ul>
                </nav>

                {/* {this.state.user.roleID === 1 && */}
                <div>
                    <button className='btn' type='button' onClick={this.setEditable}>
                        Edit
                    </button>
                    <button className='btn' onClick={() => { this.onChangeSave() }} type="button">
                        Save
                    </button>
                    <button className='btn' onClick={this.onCancel} type="button">
                        Cancel
                    </button>
                </div>
                {/* } */}
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
                            !(this.state.customersShown === undefined) && this.state.customersShown.map((customer) => {
                                return (
                                    <tr key={customer.id} onChange={
                                        (e) => this.onInputChange(e, customer.id)}>
                                        <td>
                                            <div hidden={this.state.editable}>
                                                {customer.firstname}
                                            </div>
                                            <input hidden={!this.state.editable}
                                                fieldname="firstname"
                                                defaultValue={customer.firstname}></input>
                                        </td>
                                        <td>
                                            <div hidden={this.state.editable}>
                                                {customer.lastname}
                                            </div>
                                            <input hidden={!this.state.editable}
                                                fieldname="lastname"
                                                defaultValue={customer.lastname}></input>
                                        </td>
                                        <td>
                                            <div hidden={this.state.editable}>
                                                {customer.email}
                                            </div>
                                            <input hidden={!this.state.editable}
                                                fieldname="email"
                                                defaultValue={customer.email}></input>
                                        </td>
                                        <td>
                                            <div hidden={this.state.editable}>
                                                {customer.phone}
                                            </div>
                                            <input hidden={!this.state.editable}
                                                fieldname="phone"
                                                defaultValue={customer.phone}></input>
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