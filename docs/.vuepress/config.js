module.exports = {
    title: 'Lump',
    description: 'A simple library for JSON and data objects.',
    base: '/lump/',
    themeConfig: {
        nav: [
            {text: 'Guide', link: '/'},
            {text: 'GitHub', link: 'http://github.com/jswinborne/lump'},
            {
                text: 'Packagist',
                link: 'https://packagist.org/packages/jswinborne/lump',
            },
        ],
        sidebar: [
            '/',
            {
                title: 'Documentation',
                collapsable: true,
                children: [
                    '/pages/lump',
                    '/pages/collections',
                    '/pages/factory',
                ],
            },
        ],
        displayAllHeaders: true,
        sidebarDepth: 2,
    },
}