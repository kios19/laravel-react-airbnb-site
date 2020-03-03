import ReactDOM from 'react-dom'
import React, {Component} from 'react';


class App extends Component {

    componentDidMount() {

    }

    render() {

        return (
            <div>heass</div>
        );
    }
}

export default App;

if (document.getElementById('homer')) {
    var data = document.getElementById('info').getAttribute('data');
    ReactDOM.render(<App data={data}/>, document.getElementById('homer'));
}
