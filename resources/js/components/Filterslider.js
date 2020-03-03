import ReactDOM from 'react-dom'
import React, {Component, Children} from 'react';

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
import { Provider} from "react-redux";
import { Rate, Icon, Slider } from 'antd';


function mapDispatchToProps(dispatch)
{
    return{
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

function onChange(value) {
    console.log('onChange: ', value);
    window.location.replace("/slider/"+value);
  }


class App extends Component {
    constructor(props){
        super(props);
    }


    componentDidMount() {

    }

    render() {
        return(
            <Slider min={200} max={20000} onAfterChange={onChange} defaultValue={200} tooltipVisible />
        )
    }
}

const Block = connect(
    mapStateToProps,
    mapDispatchToProps
)(App);
export default Block;

if (document.getElementById('slides')) {
    var data = document.getElementById('infosa').getAttribute('data');
    ReactDOM.render(<Provider store={store}><Block data={data}/></Provider>, document.getElementById('slides'));
}
