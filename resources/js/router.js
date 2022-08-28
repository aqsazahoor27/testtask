import { createWebHistory, createRouter } from "vue-router";

const routes = [
    {
        path: "/home",
        name: "Dashboard",
        component: () => import("./components/dashboard/Index.vue"),
    },
    {
        path: "/search",
        name: "Search",
        component: () => import("./components/dashboard/Search/Index.vue"),
    },
    {
        path: "/enneagram/:id",
        name: "enneagram",
        component: () => import("./components/test/MainTest.vue"),
    },
    {
        path: "/testresults/:id",
        name: "testresults",
        component: () => import("./components/test/TestResults.vue"),
    },
    {
        path: "/about",
        name: "About",
        component: () => import("./components/layout/Header.vue"),
    },
    {
        path: "/login",
        name: "Login",
        component: () => import("./components/auth/Login.vue"),
    },
    {
        path: "/register/:referral_user_name?",
        name: "Register",
        component: () => import("./components/auth/Register.vue"),
    },
    {
        path: "/forgotpassword",
        name: "Forgot Password",
        component: () => import("./components/auth/Forgotpassword.vue"),
    },
    {
        path: "/verifyEmail",
        name: "Verify Email",
        component: () => import("./components/auth/VerifyEmail.vue"),
    },
    {
        path: "/payment/:id",
        name: "payment",
        component: () => import("./components/Payment/Index.vue"),
    },
    {
        path: "/training/:type",
        name: "training",
        component: () => import("./components/Training/Index.vue"),
    },
    {
        path: "/my_training",
        name: "my_training",
        component: () => import("./components/MyTrainings/Index.vue"),
    },
    {
        path: "/chats",
        name: "chats",
        component: () => import("./components/chat/Chats.vue"),
    },
    {
        path: "/notifications",
        name: "notification",
        component: () => import("./components/Notifications/Index.vue"),
    },
    {
        path: "/training_detail/:id",
        name: "training_detail",
        component: () => import("./components/Trainings/Detail.vue"),
    },
    {
        path: "/training_detail/:user_name/:training_slug",
        name: "training_detail",
        component: () => import("./components/Trainings/Detail.vue"),
    },
    {
        path: "/feed_detail/:id",
        name: "feed_detail",
        component: () => import("./components/Trainings/FeedDetail.vue"),
    },
    {
        path: "/training_resources",
        name: "training_resources",
        component: () => import("./components/TrainingResources/Index.vue"),
    },
    {
        path: "/my_enrollments",
        name: "my_enrollments",
        component: () => import("./components/MyEnrollments/MyEnrollments.vue"),
    },
    {
        path: "/top_courses",
        name: "top_courses",
        component: () => import("./components/TopCourses/TopCourses.vue"),
    },
    {
        path: "/my_purchases",
        name: "my_purchases",
        component: () => import("./components/MyPurchases/MyPurchases.vue"),
    },
    {
        path: "/checkout/:training_id",
        name: "checkout",
        component: () => import("./components/Checkout/Index.vue"),
    },
    {
        path: "/course-categories",
        name: "classroom",
        component: () => import("./components/Classrooms/Index.vue"),
    },
    {
        path: "/alltrainings",
        name: "alltrainings",
        component: () => import("./components/Alltraining/Index.vue"),
    },
    {
        path: "/tutorials",
        name: "tutorials",
        component: () => import("./components/Tutorial/Index.vue"),
    },
    {
        path: "/courses",
        name: "courses",
        component: () => import("./components/Courses/Index.vue"),
    },
    {
        path: "/certifiedcourses",
        name: "certifiedcourses",
        component: () => import("./components/CertifiedCourses/Index.vue"),
    },
    {
        path: "/videos",
        name: "videos",
        component: () => import("./components/Videos/Index.vue"),
    },
    {
        path: "/addresources/:type",
        name: "addresources",
        component: () => import("./components/AddResources/Index.vue"),
    },
    {
        path: "/editresources/:type/:id",
        name: "editresources",
        component: () => import("./components/AddResources/Index.vue"),
    },
    {
        path: "/lesson_detail/:id",
        name: "lesson_detail",
        component: () => import("./components/Lesson/Index.vue"),
    },
    {
        path: "/addlesson/:training_resource_id",
        name: "add_lesson",
        component: () => import("./components/AddLesson/Index.vue"),
    },
    {
        path: "/addpost",
        name: "add_post",
        component: () => import("./components/AddPost/Index.vue"),
    },
    // {
    //     path: "/profile/:id?",
    //     name: "profile",
    //     component: () => import("./components/Profile/Profile.vue"),
    // },
    {
        path: "/profile/:user_name?/:training_slug?",
        name: "profile",
        component: () => import("./components/Profile/Profile.vue"),
    },
    {
        path: "/setting/",
        name: "setting",
        component: () => import("./components/Setting/Index.vue"),
    },
    {
        path: "/settings/display/",
        name: "settings-display",
        component: () => import("./components/Setting/Display.vue"),
    },
    {
        path: "/settings/notification/",
        name: "settings-notification",
        component: () => import("./components/Setting/Notification.vue"),
    },
      {
        path: "/settings/sitenotification",
        name: "sitenotification",
        component: () => import("./components/Sitenotification/Index.vue"),
    },

    {
        path: "/settings/privacy",
        name: "settings-privacy",
        component: () => import("./components/Setting/Privacy.vue"),
    },
    {
        path: "/settings/account/",
        name: "settings-account",
        component: () => import("./components/Setting/Account/Account.vue"),
    },
    // {
    //     path: "/settings/billing",
    //     name: "settings-billing",
    //     component: () => import("./components/Subscription/Index.vue"),
    // },
    {
        path: "/videoStreaming/:training_id",
        name: "videoStreaming",
        component: () => import("./components/Global/VideoStreaming"),
    },
    {
        path: "/account/password/",
        name: "account-password",
        component: () => import("./components/Setting/Account/Password.vue"),
    },
    {
        path: "/account/verify/",
        name: "account-verify",
        component: () => import("./components/Setting/Account/Verify.vue"),
    },
    {
        path: "/account/kyc/",
        name: "account-kyc",
        component: () => import("./components/Setting/Account/KYC.vue"),
    },
    {
        path: "/account/profile/",
        name: "account-profile",
        component: () => import("./components/Setting/Account/Profile.vue"),
    },

    {
        path: "/settings/analytics",
        name: "settings-analytics",
        component: () => import("./components/Setting/Analytics.vue"),
    },

    {
        path: "/settings/referrals",
        name: "settings-referrals",
        component: () => import("./components/Setting/Referral_Program.vue"),
    },
    {
        path: "/bookmarks/certifiedcourses",
        name: "bookmarks-certifiedcourses",
        component: () => import("./components/Bookmarks/CertifiedCourses.vue"),
    },
    {
        path: "/bookmarks/courses",
        name: "bookmarks-courses",
        component: () => import("./components/Bookmarks/Courses.vue"),
    },
    {
        path: "/bookmarks/videos",
        name: "bookmarks-videos",
        component: () => import("./components/Bookmarks/Video.vue"),
    },
    {
        path: "/bookmarks/post",
        name: "bookmarks-post",
        component: () => import("./components/Bookmarks/Posts.vue"),
    },
    {
        path: "/bookmark",
        name: "bookmark",
        component: () => import("./components/Bookmark/Bookmarks.vue"),
    },
    {
        path: "/landing-page",
        name: "landing-page",
        component: import("./components/LandingPage/LandingPage.vue"),
    },
    {
        path: "/gallery",
        name: "gallery",
        component: () => import("./components/PublicFront/gallery/Index.vue"),
    },
    {
        path: "/",
        name: "home",
        component: () => import("./components/PublicFront/sales/Index.vue"),
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from, next) => {
    var login = window.location.href.indexOf("login") > -1;
    var register = window.location.href.indexOf("register") > -1;
    var forgot = window.location.href.indexOf("forgotpassword") > -1;
    var gallery = window.location.href.indexOf("gallery") > -1;
    var userInfo = JSON.parse(localStorage.getItem("userInfo"));
    var origin=window.location.origin+'/';
    var href=window.location.href;

    if(userInfo){
        if(new Date().getTime() > userInfo.expiry){
            localStorage.removeItem('userInfo')
            window.location.href = "/login";
        }
    }

    if (localStorage.userInfo == null && login == false  && gallery == false && register == false && forgot == false && origin!=href ) {
        // window.location.href = "/login";
    }

    if(to.name == 'my_training' && localStorage.userInfo){
        
        if(userInfo.role_id != 1){
            if(userInfo.membership_plan_code != 'certified-plan'){
                window.location.href = "/";
                return
            }
        }

    }

    next();

});

router.onError(error => {

    if (/loading chunk \d* failed./i.test(error.message) && navigator.onLine) {
        window.location.reload()
    }

});
router.onError((error) => {
    const pattern = /Loading chunk (\d)+ failed/g;
    const isChunkLoadFailed = error.message.match(pattern);
    const targetPath = router.history.pending.fullPath;
    if (isChunkLoadFailed) {
        router.replace(targetPath);
    }
});



router.afterEach(() => {
    window.scrollTo(0, 0);
  });

export default router;
