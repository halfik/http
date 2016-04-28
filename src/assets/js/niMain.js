/**
 * @param route
 * @param params
 * @returns {*}
 */
niRouteUrl = function(route, params){
    $.each(params, function(k,v){
        route = route.replace(k,v)
    });
    return route;
};
