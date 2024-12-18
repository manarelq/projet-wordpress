import { __ } from "@wordpress/i18n"
import * as images from "../../components/images"
const Offers = () => {

    const offerBannerLists = [
        {
            image: images.themeClub,
            imageUrl: cw_dashboard.theme_club_upgrade,
            title: __("Theme Club", 'blossom-fashion'),
        },
        {
            image: images.salesFunnel,
            imageUrl: cw_dashboard.sales_funnel,
            title: __("Sales Funnel", 'blossom-fashion'),
        },
        {
            image: images.customFonts,
            imageUrl: cw_dashboard.custom_fonts,
            title: __("Custom Fonts", 'blossom-fashion'),
        },
        {
            image: images.vipSiteCare,
            imageUrl: cw_dashboard.vip_site_care,
            title: __("VIP Site Care", 'blossom-fashion'),
        },
    ]

    const offerCardLists = [
        {
            image: images.themeInstallation,
            imageUrl: cw_dashboard.theme_install,
            title: __("Theme Installation & Setup", 'blossom-fashion'),
        },
        {
            image: images.GDPR,
            imageUrl: cw_dashboard.gdpr_setup,
            title: __("GDPR Compliance", 'blossom-fashion'),
        },
        {
            image: images.SEO,
            imageUrl: cw_dashboard.seo_setup,
            title: __("Must Have SEO Setup", 'blossom-fashion'),
        },
        {
            image: images.pluginsSetup,
            imageUrl: cw_dashboard.plugin_setup,
            title: __("Must Have Plugins Setup", 'blossom-fashion'),
        },
        {
            image: images.vipSupport,
            imageUrl: cw_dashboard.vip_support,
            title: __("VIP Support", 'blossom-fashion'),
        },
    ]


    return (
        <>
            <div className="cw-offer">
                <div className="banner-section">
                    {offerBannerLists.map((banner, index) => (
                        <a className="image-link" href={banner.imageUrl} key={index} target="_blank">
                            <img src={banner.image} alt={banner.title} />
                        </a>
                    ))}
                </div>
                <div className="card-section">
                    {offerCardLists.map((card, index) => (
                        <a className="image-link" href={card.imageUrl} key={index} target="_blank">
                            <img src={card.image} alt={card.title} />
                        </a>
                    ))}
                </div>
            </div>
        </>
    )
}

export default Offers;