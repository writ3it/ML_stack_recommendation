/**
 * Code based on https://developers.google.com/web/fundamentals/codelabs/push-notifications/
 */

export class VueWebPush{

    constructor() {
        const INIT = 0;
        this.worker = false;
        this.isSubscriber = false;
    }

    RegisterWorker(workerName){
        let that = this;
        return new Promise(function(resolve, reject){
            if (!that.IsSupported()){
                reject('WebPush is not supported!');
                return false;
            }
            let state = false;

            navigator.serviceWorker.register(workerName)
            .then(function(swReg){
                that.worker = swReg;
                that.detectIsSubscriberState().catch(function(){
                }).finally(function(){
                    resolve();
                });
            })
            .catch(function(error){
                reject(error);
            });
            return state;
        });
    }

    Subscribe(applicationServerPublicKey){
        const applicationServerKey = this.urlB64ToUint8Array(applicationServerPublicKey);
        let that = this;
        return new Promise(function(resolve, reject) {
            this.worker.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: applicationServerKey
            }).then(function (subscription) {
                that.isSubscriber = true;
                resolve(subscription);
            }).catch(function (error) {
                that.isSubscriber = false;
                reject(error);
            });
        });
    }

    /**
     * From https://github.com/GoogleChromeLabs/web-push-codelab/blob/master/app/scripts/main.js
     * @param base64String
     * @returns {Uint8Array}
     */
    urlB64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding)
            .replace(/\-/g, '+')
            .replace(/_/g, '/');

        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);

        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }

    get IsSubscribed(){
        return this.isSubscriber;
    }

    IsSupported(){
        return 'serviceWorker' in navigator && 'PushManager' in window;
    }

    detectIsSubscriberState() {
        let that = this;
        return new Promise(function (resolve, reject) {
            that.worker.pushManager.getSubscription().then(function(subscription){
                console.log(subscription);
                that.isSubscriber = !(subscription === null);
                if (that.isSubscriber){ resolve(); } else { reject(); }
            })
        });
    }
}

export default function (Vue, options){
  Vue.prototype.$webpush = new VueWebPush();
};