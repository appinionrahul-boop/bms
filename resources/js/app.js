require('./bootstrap');
const React = require('react');
const ReactDOM = require('react-dom');
const DashboardAppModule = require('./components/DashboardApp');
const DashboardApp = DashboardAppModule.default || DashboardAppModule;

document.addEventListener('DOMContentLoaded', () => {
    const dashboardRoot = document.getElementById('dashboard-root');

    if (!dashboardRoot) {
        return;
    }

    const dashboardPayload = dashboardRoot.dataset.dashboard;
    const dashboardData = dashboardPayload ? JSON.parse(dashboardPayload) : {};

    ReactDOM.render(
        React.createElement(DashboardApp, { data: dashboardData }),
        dashboardRoot
    );
});
