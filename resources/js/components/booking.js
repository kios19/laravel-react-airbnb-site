import ReactDOM from 'react-dom'
import React, { Component, Children } from 'react';
import { DatePicker, InputNumber, Row, Col, Button, Form, Icon, Input } from 'antd';
import 'antd/dist/antd.css';
const { MonthPicker, RangePicker, WeekPicker } = DatePicker;
import store from "../store";
import { addDate } from "../actions";
import { addEndDate } from "../actions";
import { addRoom } from "../actions";
import { addChildren } from "../actions";
import { addAdults } from "../actions";
import { addTotal } from "../actions";
import { addRiver } from "../actions";
import Swal from 'sweetalert2'

import { connect } from "react-redux";
import { Provider } from "react-redux";

// import  '../globals/globals' as globe;
const globe = require('../globals/globals.json')

function onChange(date, dateString) {
    //console.log(date, dateString);
}


function onOk(value) {
    //console.log('onOk: ', value[0]._d);
    var ontime = value[0]._d.toISOString().slice(0, 19).replace('T', ' ');
    var offtime = value[1]._d.toISOString().slice(0, 19).replace('T', ' ');
    console.log('start date : ', ontime);
    console.log('end time : ', offtime);

    var kitu = decodeURIComponent(data).replace(/\+/g, " ");
    var tiku = JSON.parse(kitu)

    if (tiku[1]) {
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------734995677216218208777871");

        var formdata = new FormData();
        formdata.append("title", this.props.river[0].title);
        formdata.append("type", this.props.river[0].type);
        formdata.append("guests", this.props.total);
        formdata.append("children", this.props.children);
        formdata.append("adults", this.props.adults);
        formdata.append("beds", this.props.river[0].beds);
        formdata.append("price", this.props.river[0].price);
        formdata.append("location", this.props.river[0].location);
        formdata.append("description", this.props.river[0].description);
        formdata.append("deposit", "0");
        formdata.append("condition", this.props.river[0].condition);
        formdata.append("image1", this.props.river[0].image1);
        formdata.append("image2", this.props.river[0].image2);
        formdata.append("image3", this.props.river[0].image3);
        formdata.append("start_time", ontime);
        formdata.append("end_time", offtime);
        formdata.append("user_id", this.props.river[1].user_id);
        formdata.append("room_id", tiku[0].id)
        formdata.append("admin_id", tiku[0].user_id)

        var requestOptions = {
            method: 'POST',
            //headers: myHeaders,
            body: formdata,
            redirect: 'follow'
        };

        fetch(globe.book_url, requestOptions)
            .then(response => response.text())
            .then(result => {
                if (result == "200") {
                    Swal.fire({
                        title: 'Awesome',
                        text: 'Your Booking was successfully done',
                        icon: 'success',
                        confirmButtonText: 'Cool'
                    }).then((result) => {
                        if (result.value) {
                            var kitu = decodeURIComponent(data).replace(/\+/g, " ");
                            var tiku = JSON.parse(kitu)
                            window.location.replace("/invoice/" + tiku[0].id + "/" + this.props.total)
                        }
                    })
                }
                if (result == "401") {
                    Swal.fire({
                        title: 'Sorry!',
                        text: 'Dates already booked',
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })
                }
            })
            .catch(error => {
                console.log('error', error.message)
            });
    } else {
        console.log("not logged in")
        this.setState({ tinkerbell: "none" });
        sessionStorage.setItem('stime', ontime);
        sessionStorage.setItem('etime', offtime)
        console.log("props date", sessionStorage.getItem('stime'))

        sessionStorage.setItem('display',"" )
        this.setState({ display: "" })

    }


}

function childrennumbers(value) {
    console.log('changed', value)
    this.props.addChildren(value)
    var life = this.props.children + this.props.adults + 1
    this.props.addTotal(life)
    console.log(life)
}

function adultnumbers(value) {
    console.log(this.props.addAdults)
    this.props.addAdults(value);
    var life = this.props.children + this.props.adults + 1
    this.props.addTotal(life)
}

function mapDispatchToProps(dispatch) {
    return {
        addDate: sdate => dispatch(addDate(sdate)),
        addEndDate: edate => dispatch(addEndDate(edate)),
        addChildren: children => dispatch(addChildren(children)),
        addAdults: adults => dispatch(addAdults(adults)),
        addTotal: total => dispatch(addTotal(total)),
        addRiver: river => dispatch(addRiver(river))
    }
}
function hasErrors(fieldsError) {
    return Object.keys(fieldsError).some(field => fieldsError[field]);
}

const mapStateToProps = state =>
    ({
        sdate: state.sdate,
        edate: state.edate,
        room: state.room,
        children: state.children,
        adults: state.adults,
        total: state.total,
        river: state.river
    })

class App extends Component {
    state = {
        tinkerbell: "",
        stime: "",
        etime: "",
        display: "none"
    }
    constructor(props) {
        super(props);

        onOk = onOk.bind(this);
        this.handleSubmite = this.handleSubmite.bind(this);
        onChange = onChange.bind(this);
        childrennumbers = childrennumbers.bind(this);
        adultnumbers = adultnumbers.bind(this);
        this.componentDidMount = this.componentDidMount.bind(this);
    }

    componentDidMount() {
        var kitu = decodeURIComponent(data).replace(/\+/g, " ");
        console.log(kitu)

        var kitu = decodeURIComponent(data).replace(/\+/g, " ");
        var tiku = JSON.parse(kitu)
        this.props.addRiver(tiku)
        console.log(tiku[0])
        console.log("river", this.props.river)
        console.log("shiwdren", tiku)
        this.props.form.validateFields();

        sessionStorage.setItem('display',"none" )

    }
    handleSubmite = e => {
        e.preventDefault();
        this.props.form.validateFields((err, values) => {
            if (!err) {

                var kitu = decodeURIComponent(data).replace(/\+/g, " ");
                var tiku = JSON.parse(kitu)


                console.log('Received values of form: ', values);
                var myHeaders = new Headers();
                myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------907414989736681898743004");

                var formdata = new FormData();
                formdata.append("email", values.username);

                var requestOptions = {
                    method: 'POST',
                    //headers: myHeaders,
                    body: formdata,
                    redirect: 'follow'
                };

                fetch(globe.login_url, requestOptions)
                    .then(response => response.text())
                    .then(result => {
                        //console.log(result)
                        const kiss = JSON.parse(result)
                        const pass = kiss[0].password
                        sessionStorage.setItem('bud', kiss[0].id)
                        console.log(pass)

                        var myHeaders = new Headers();
                        myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------019859349831192330971528");

                        var formdata = new FormData();
                        formdata.append("usergiv", values.password);
                        formdata.append("password", pass);

                        var requestOptions = {
                            method: 'POST',
                            //headers: myHeaders,
                            body: formdata,
                            redirect: 'follow'
                        };

                        fetch(globe.chet_url, requestOptions)
                            .then(response => response.text())
                            .then(result => {
                                console.log(result)
                                if (result == "true") {
                                    var kitu = decodeURIComponent(data).replace(/\+/g, " ");
                                    var tiku = JSON.parse(kitu)
                                    var myHeaders = new Headers();
                                    myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------734995677216218208777871");

                                    var formdata = new FormData();
                                    formdata.append("title", this.props.river[0].title);
                                    formdata.append("type", this.props.river[0].type);
                                    formdata.append("guests", this.props.total);
                                    formdata.append("children", this.props.children);
                                    formdata.append("adults", this.props.adults);
                                    formdata.append("beds", this.props.river[0].beds);
                                    formdata.append("price", this.props.river[0].price);
                                    formdata.append("location", this.props.river[0].location);
                                    formdata.append("description", this.props.river[0].description);
                                    formdata.append("deposit", "0");
                                    formdata.append("condition", this.props.river[0].condition);
                                    formdata.append("image1", this.props.river[0].image1);
                                    formdata.append("image2", this.props.river[0].image2);
                                    formdata.append("image3", this.props.river[0].image3);
                                    formdata.append("start_time", sessionStorage.getItem('stime'));
                                    formdata.append("end_time", sessionStorage.getItem('etime'));
                                    formdata.append("user_id", sessionStorage.getItem('bud'));
                                    formdata.append("room_id", tiku[0].id)
                                    formdata.append("admin_id", tiku[0].user_id)

                                    var requestOptions = {
                                        method: 'POST',
                                        //headers: myHeaders,
                                        body: formdata,
                                        redirect: 'follow'
                                    };

                                    fetch(globe.book_url, requestOptions)
                                        .then(response => response.text())
                                        .then(result => {
                                            if (result == "200") {
                                                Swal.fire({
                                                    title: 'Awesome',
                                                    text: 'Your Booking was successfully done',
                                                    icon: 'success',
                                                    confirmButtonText: 'Cool'
                                                }).then((result) => {
                                                    if (result.value) {
                                                        var kitu = decodeURIComponent(data).replace(/\+/g, " ");
                                                        var tiku = JSON.parse(kitu)
                                                        //window.location.replace("/invoice/" + tiku[0].id + "/" + this.props.total)
                                                        window.location.replace("/loginas/"+sessionStorage.getItem('bud')+"/"+tiku[0].id+"/"+this.props.total)
                                                    }
                                                })
                                            }
                                            if (result == "401") {
                                                Swal.fire({
                                                    title: 'Sorry!',
                                                    text: 'Dates already booked',
                                                    icon: 'error',
                                                    confirmButtonText: 'Cool'
                                                })
                                            }
                                        })
                                        .catch(error => {
                                            console.log('error', error.message)
                                        });
                                } else {
                                    Swal.fire({
                                        title: 'Login failed, maybe its the spelling',
                                        showClass: {
                                          popup: 'animated fadeInDown faster'
                                        },
                                        hideClass: {
                                          popup: 'animated fadeOutUp faster'
                                        }
                                      })
                                }
                            })
                            .catch(error => console.log('error', error));

                    })
                    .catch(error => console.log('error', error));
            }
        });
    }
    render() {

        var kitu = decodeURIComponent(data).replace(/\+/g, " ");
        var tiku = JSON.parse(kitu)

        const { getFieldDecorator, getFieldsError, getFieldError, isFieldTouched } = this.props.form;

        const usernameError = isFieldTouched('username') && getFieldError('username');
        const passwordError = isFieldTouched('password') && getFieldError('password');
        if (!tiku[1]) {
            return (
                <div>
                    <Row>
                        <Col xs={{ span: 5, offset: 1 }} lg={{ span: 6 }}>
                            <h3 className="h5 text-black mb-3">Adults</h3>
                            <InputNumber className="form-control" label="total" size="large" min={0} max={tiku[0].adults} defaultValue={0} onChange={adultnumbers} />
                        </Col>
                        <Col xs={{ span: 5, offset: 1 }} lg={{ span: 6, offset: 2 }}>
                            <h3 className="h5 text-black mb-3">Children</h3>
                            <InputNumber label="total" size="large" min={0} max={tiku[0].children} defaultValue={0} onChange={childrennumbers} />
                        </Col>
                        <Col xs={{ span: 5, offset: 1 }} lg={{ span: 6, offset: 2 }}>
                            <h3 className="h5 text-black mb-3">Total</h3>
                            <p class="custom-pagination">

                                <a href="#">{this.props.total}</a>
                            </p>
                        </Col>
                    </Row>
                    <br />
                    <Col>
                        <h3 className="h5 text-black mb-3">Pick a Date and Time</h3>
                        <RangePicker
                            showTime={{ format: 'HH:mm' }}
                            format="YYYY-MM-DD HH:mm"
                            placeholder={['Start Time', 'End Time']}
                            onChange={onChange}
                            onOk={onOk}
                        />
                        <Form  onSubmit={this.handleSubmite} style={{ display: this.state.display, paddingTop: 50 }}>
                            <Form.Item validateStatus={usernameError ? 'error' : ''} help={usernameError || ''}>
                                {getFieldDecorator('username', {
                                    rules: [{ required: true, message: 'Please input your username!' }],
                                })(
                                    <Input
                                        prefix={<Icon type="user" style={{ color: 'rgba(0,0,0,.25)' }} />}
                                        placeholder="Email"
                                    />,
                                )}
                            </Form.Item>
                            <Form.Item validateStatus={passwordError ? 'error' : ''} help={passwordError || ''}>
                                {getFieldDecorator('password', {
                                    rules: [{ required: true, message: 'Please input your Password!' }],
                                })(
                                    <Input
                                        prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />}
                                        type="password"
                                        placeholder="Password"
                                    />,
                                )}
                            </Form.Item>
                            <Form.Item>
                                <Button  style={{ background: "#7971ea", width: "100%"}} type="primary" htmlType="submit" disabled={hasErrors(getFieldsError())}>
                                    Log in
                                </Button>
                            </Form.Item>
                        </Form>
                    </Col>
                    <br />
                </div>
            );
        } else {
            return (
                <div>
                    <Row>
                        <Col xs={{ span: 5, offset: 1 }} lg={{ span: 6 }}>
                            <h3 className="h5 text-black mb-3">Adults</h3>
                            <InputNumber className="form-control" label="total" size="large" min={0} max={tiku[0].adults} defaultValue={0} onChange={adultnumbers} />
                        </Col>
                        <Col xs={{ span: 5, offset: 1 }} lg={{ span: 6, offset: 2 }}>
                            <h3 className="h5 text-black mb-3">Children</h3>
                            <InputNumber label="total" size="large" min={0} max={tiku[0].children} defaultValue={0} onChange={childrennumbers} />
                        </Col>
                        <Col xs={{ span: 5, offset: 1 }} lg={{ span: 6, offset: 2 }}>
                            <h3 className="h5 text-black mb-3">Total</h3>
                            <p class="custom-pagination">

                                <a href="#">{this.props.total}</a>
                            </p>
                        </Col>
                    </Row>
                    <br />
                    <Col>
                        <h3 className="h5 text-black mb-3">Pick a Date and Time</h3>
                        <RangePicker
                            showTime={{ format: 'HH:mm' }}
                            format="YYYY-MM-DD HH:mm"
                            placeholder={['Start Time', 'End Time']}
                            onChange={onChange}
                            onOk={onOk}
                        />
                    </Col>
                    <br />
                </div>
            );
        }
    }
}
const Bapp = Form.create({ name: 'horizontal_login' })(App);

const Block = connect(
    mapStateToProps,
    mapDispatchToProps
)(Bapp);
export default Block;

if (document.getElementById('homer')) {
    var data = document.getElementById('info').getAttribute('data');
    ReactDOM.render(<Provider store={store}><Block data={data} /></Provider>, document.getElementById('homer'));
}
