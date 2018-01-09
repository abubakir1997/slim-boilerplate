import CASE   from '../cases'

/*
 * Initial States
 */

export const initState = {
	value: 0
}

/*
 * Implementation
 */

export const handler = (state = initState, { type, payload }) =>
{
    switch (type) 
    {
        case CASE.INC:
            return {
                ...state,
                value: state.value + 1
            }
        case CASE.DEC:
            return {
                ...state,
                value: state.value - 1
            }
        default:
            return state
    }
}

export default
{
    initState,
    handler
}