module.exports = function (grunt) {
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        clean: {
            build: ['build/codingsimply-projects']
        },
        copy: {
            libs: {
                files: []
            },
            build: {
                files: [
                    {
                        src: [
                            'vendor/**',
                            'src/**',
                            '*.php',
                            'README.md',
                            'LICENSE'
                        ],
                        dest: 'build/codingsimply-projects/'
                    }
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');

    grunt.registerTask('build', ['clean:build', 'copy:build']);

    grunt.registerTask('default', ['build']);
};