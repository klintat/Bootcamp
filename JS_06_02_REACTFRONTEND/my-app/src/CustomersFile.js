import React from 'react';
import Customers from './Customers';

class CustomersFile extends React.Component {

    customersInit = (sourceObj) => {
        const headers = new Headers();
        const filename = this.props.filename
        headers.append("Content-type", "application/json");
        fetch("http://localhost/my-app-backend/getFileContent.php", {
            method: "POST",
            headers: headers,
            body: JSON.stringify(filename)
        }).then(function (response) {
            if (response.ok) {
                response.json().then(data => {
                    sourceObj.setCustomerTable(data.customers);
                });
            }
        })
    }

    render() {
        return (
            <Customers customersInit={this.customersInit} allNew={true}></Customers>
        )
    }

}

export default CustomersFile