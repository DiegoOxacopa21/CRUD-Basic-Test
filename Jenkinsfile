pipeline {
    agent any

    environment {
        APP_ENV = 'testing'
        DB_CONNECTION = 'sqlite'
        DB_DATABASE = ':memory:'
    }

    triggers {
        pollSCM('')
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Install Dependencies') {
            steps {
                bat 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Prepare Environment') {
            steps {
                bat '''
                    copy .env.example .env /Y
                    php artisan key:generate --force
                '''
            }
        }

        stage('Run Tests') {
            steps {
                bat 'php artisan test --log-junit=junit.xml'
            }
            post {
                always {
                    junit testResults: 'junit.xml', allowEmptyResults: true
                }
            }
        }
    }

    post {
        success {
            emailext(
                to: 'diegooxacopa64@gmail.com',
                subject: "SUCCESS: ${env.JOB_NAME} - ${env.BUILD_NUMBER}",
                body: "Build Successful!\nJob: ${env.JOB_NAME}\nBuild: ${env.BUILD_NUMBER}\nURL: ${env.BUILD_URL}\nBranch: ${env.BRANCH_NAME}"
            )
        }

        failure {
            emailext(
                to: 'diegooxacopa64@gmail.com',
                subject: "FAILED: ${env.JOB_NAME} - ${env.BUILD_NUMBER}",
                body: "Build Failed!\nJob: ${env.JOB_NAME}\nBuild: ${env.BUILD_NUMBER}\nURL: ${env.BUILD_URL}\nBranch: ${env.BRANCH_NAME}\nCheck console output."
            )
        }

        unstable {
            emailext(
                to: 'diegooxacopa64@gmail.com',
                subject: "UNSTABLE: ${env.JOB_NAME} - ${env.BUILD_NUMBER}",
                body: "Build Unstable (tests failed)\nJob: ${env.JOB_NAME}\nBuild: ${env.BUILD_NUMBER}\nURL: ${env.BUILD_URL}\nBranch: ${env.BRANCH_NAME}"
            )
        }

        cleanup {
            deleteDir()
        }
    }
}
