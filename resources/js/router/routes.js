const routes = [
    {
        path: '',
        name: 'index',
        component: require('../views/index/Index.vue').default,
    },
    {
        path: '/project',
        name: 'project.index',
        component: require('../views/project/Index.vue').default,
    },
    {
        path: '/project/add',
        name: 'project.add',
        component: require('../views/project/Add.vue').default,
        meta: {
            requiredRole: ['nhom-kinh-doanh']
        }
    },
    {
        path: '/project/edit-dev/:id',
        name: 'project.edit.dev',
        component: require('../views/project/EditDev.vue').default,
        
        props: true
    },
    {
        path: '/project/edit-sale/:id',
        name: 'project.edit.sale',
        component: require('../views/project/EditSale.vue').default,
        meta: {
            requiredRole: ['nhom-kinh-doanh']
        },
        props: true
    },
    {
        path: '/member/edit/:id',
        name: 'member.edit',
        component: require('../views/members/Edit.vue').default,
        props: true
    },
    {
        path: '*',
        name: '404',
        component: require('../views/errors/Error404.vue').default
    }
];

export default routes;