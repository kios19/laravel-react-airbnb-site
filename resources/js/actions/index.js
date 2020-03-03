import { ADD_DATE, ADD_ROOM } from "../constants/action-types";
import { ADD_END_DATE } from "../constants/action-types";
import { ADD_ADULTS } from "../constants/action-types";
import { ADD_CHILDREN} from "../constants/action-types";
import { ADD_TOTAL } from "../constants/action-types";
import { ADD_RIVER } from "../constants/action-types";
import { ADD_RATING } from "../constants/action-types";

export function addDate(payload){
    return{ type: ADD_DATE, payload}
}
export function addEndDate(payload){
    return{ type: ADD_END_DATE, payload}
}
export function addRoom(payload){
    return{ type: ADD_ROOM, payload}
}
export function addChildren(payload){
    return{ type: ADD_CHILDREN, payload}
}
export function addAdults(payload){
    return{ type: ADD_ADULTS, payload}
}
export function addTotal(payload){
    return{ type: ADD_TOTAL, payload}
}
export function addRiver(payload){
    return{ type: ADD_RIVER, payload}
}
export function addRating(payload){
    return{ type: ADD_RATING, payload}
}
