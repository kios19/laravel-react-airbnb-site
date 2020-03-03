import ReactDOM from 'react-dom'
import React, { Component, Children } from 'react';

import store from "../store";
import { addDate } from "../actions";
import { addEndDate } from "../actions";
import { addRoom } from "../actions";
import { addChildren } from "../actions";
import { addAdults } from "../actions";
import { addTotal } from "../actions";
import { addRiver } from "../actions";
import { addRating } from "../actions";

import { connect } from "react-redux";
import { Provider } from "react-redux";
import { Rate, Icon } from 'antd';

const globe = require('../globals/globals.json')


function mapDispatchToProps(dispatch) {
    return {
        addDate: sdate => dispatch(addDate(sdate)),
        addEndDate: edate => dispatch(addEndDate(edate)),
        addChildren: children => dispatch(addChildren(children)),
        addAdults: adults => dispatch(addAdults(adults)),
        addTotal: total => dispatch(addTotal(total)),
        addRiver: river => dispatch(addRiver(river)),
        addRating: rating => dispatch(addRating(rating))
    }
}

const mapStateToProps = state =>
    ({
        sdate: state.sdate,
        edate: state.edate,
        room: state.room,
        children: state.children,
        adults: state.adults,
        total: state.total,
        river: state.river,
        rating: state.rating
    })

const desc = ['terrible', 'bad', 'normal', 'good', 'wonderful'];


class App extends Component {
    state = {
        display: "",
        seeme:""
    }
    constructor(props) {
        super(props);
        this.componentDidMount = this.componentDidMount.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

    handleChange = value => {
        //this.setState({ value });
        console.log(value);

        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------582365407117721442515594");

        var formdata = new FormData();
        formdata.append("userid", JSON.parse(data).userid);
        formdata.append("product_id", JSON.parse(data).itemid);
        formdata.append("rating", value);

        var requestOptions = {
            method: 'POST',
            //headers: myHeaders,
            body: formdata,
            redirect: 'follow'
        };

        fetch(globe.rate_url, requestOptions)
            .then(response => response.text())
            .then(result => {
                console.log(result)
                this.setState({ display: "none" });
            })
            .catch(error => console.log('error', error));
    };

    componentDidMount() {



        //console.log("pkk", JSON.parse(data).rating)
        console.log("pkk", JSON.parse(data).itemid)
        sessionStorage.setItem('seeme', "");

        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------545815181746109735112836");

        var formdata = new FormData();
        formdata.append("userid", JSON.parse(data).userid);
        formdata.append("productid", JSON.parse(data).itemid);

        var requestOptions = {
            method: 'POST',
            //headers: myHeaders,
            body: formdata,
            redirect: 'follow'
        };

        fetch(globe.check_url, requestOptions)
            .then(response => response.text())
            .then(result => {
                console.log(result)
                this.props.addRating(result)
                console.log("mclaren", this.props.rating)
            })
            .catch(error => console.log('error', error));

        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------682826678482228101652056");

        var formdata = new FormData();
        formdata.append("userid", "1");
        formdata.append("roomid", "8");

        var requestOptions = {
            method: 'POST',
            //headers: myHeaders,
            body: formdata,
            redirect: 'follow'
        };

        fetch(globe.enb_url, requestOptions)
            .then(response => response.text())
            .then(result => {
                console.log(result)
                if(result <= 0){
                    sessionStorage.setItem('seeme',"none")
                    this.setState({ seeme : "none"})
                }
            })
            .catch(error => console.log('error', error));
    }

    render() {
        if (this.props.rating === "true") {
            return (
                <div style={{ paddingTop: "40px", paddingBottom: "40px", display: this.state.seeme}}>
                    <span>
                        <Rate disabled character={<Icon type="heart" theme="filled" />} tooltips={desc} value={JSON.parse(data).rating} />
                    </span>
                </div>
            );
        }
        else {
            return (
                <div style={{ display: this.state.seeme }}>
                    <span>
                        <Rate character={<Icon type="smile" theme="filled" />} tooltips={desc} onChange={this.handleChange} value={0} style={{ display: this.state.display }} />

                    </span>
                </div>
            );
        }

    }
}

const Block = connect(
    mapStateToProps,
    mapDispatchToProps
)(App);
export default Block;

if (document.getElementById('rater')) {
    var data = document.getElementById('infos').getAttribute('data');
    ReactDOM.render(<Provider store={store}><Block data={data} /></Provider>, document.getElementById('rater'));
}
