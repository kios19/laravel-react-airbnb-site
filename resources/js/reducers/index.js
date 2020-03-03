import { ADD_DATE } from "../constants/action-types";
import { ADD_END_DATE } from "../constants/action-types";
import { ADD_ROOM } from "../constants/action-types";
import { ADD_CHILDREN } from "../constants/action-types";
import { ADD_ADULTS } from "../constants/action-types";
import { ADD_TOTAL } from "../constants/action-types";
import { ADD_RIVER } from "../constants/action-types";
import { ADD_RATING } from "../constants/action-types";

const initialState = {
    sdate: "",
    edate:"",
    room:"",
    children:0,
    adults:0,
    total: 0,
    river: "",
    rating:""
}
function rootReducer(state = initialState, action){
    if(action.type === ADD_DATE){
        return Object.assign({},state,{
            sdate : action.payload
        })
    }
    if(action.type === ADD_END_DATE){
        return Object.assign({},state,{
            edate: action.payload
        })
    }
    if(action.type === ADD_ROOM){
        return Object.assign({},state,{
            room: action.payload
        })
    }
    if(action.type === ADD_ADULTS){
        return Object.assign({},state,{
            adults: action.payload
        })
    }
    if(action.type === ADD_CHILDREN){
        return Object.assign({},state,{
            children: action.payload
        })
    }
    if(action.type === ADD_TOTAL){
        return Object.assign({},state,{
            total: action.payload
        })
    }
    if(action.type === ADD_RIVER){
        return Object.assign({},state,{
            river: action.payload
        })
    }
    if(action.type === ADD_RATING){
        return Object.assign({},state,{
            rating: action.payload
        })
    }
    return state;
}

export default rootReducer;
