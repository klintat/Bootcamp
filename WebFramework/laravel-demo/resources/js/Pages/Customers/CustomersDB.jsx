import React from 'react';
import Customers from './Customers';

class CustomersDB extends React.Component {

    customersInit = (me) => {
        const self = me;
        // fetch("http://localhost/my-app-backend/customers.php", {
        //     method: "GET"
        // }).then(function (response) {
        //     if (response.ok) {
        //         response.json().then(customers => {
        //             self.setCustomerTable(customers);
        //         });
        //     }
        // })

        const customers = this.props.customers;
        self.setCustomerTable(customers);
    }

    render() {
        return (
           <Customers csrf_token={this.props.csrf_token} customersInit={this.customersInit}></Customers>
        )
    }

}

export default CustomersDB