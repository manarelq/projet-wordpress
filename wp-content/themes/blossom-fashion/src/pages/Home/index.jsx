import { Icon, Sidebar, Card, Heading } from "../../components";
import { __ } from '@wordpress/i18n';

const Homepage = () => {
    const cardLists = [
        {
            iconSvg: <Icon icon="site" />,
            heading: __('Site Identity', 'blossom-fashion'),
            buttonText: __('Customize', 'blossom-fashion'),
            buttonUrl: cw_dashboard.custom_logo
        },
        {
            iconSvg: <Icon icon="colorsetting" />,
            heading: __("Color Settings", 'blossom-fashion'),
            buttonText: __('Customize', 'blossom-fashion'),
            buttonUrl: cw_dashboard.colors
        },
        {
            iconSvg: <Icon icon="layoutsetting" />,
            heading: __("Appearance Settings", 'blossom-fashion'),
            buttonText: __('Customize', 'blossom-fashion'),
            buttonUrl: cw_dashboard.appr
        },
        {
            iconSvg: <Icon icon="instagramsetting" />,
            heading: __("Instagram Settings", 'blossom-fashion'),
            buttonText: __('Customize', 'blossom-fashion'),
            buttonUrl: cw_dashboard.instagram
        },
        {
            iconSvg: <Icon icon="generalsetting" />,
            heading: __("General Settings"),
            buttonText: __('Customize', 'blossom-fashion'),
            buttonUrl: cw_dashboard.general
        },
        {
            iconSvg: <Icon icon="footersetting" />,
            heading: __('Footer Settings', 'blossom-fashion'),
            buttonText: __('Customize', 'blossom-fashion'),
            buttonUrl: cw_dashboard.footer
        }
    ];

    const proSettings = [
        {
            heading: __('Header Layouts', 'blossom-fashion'),
            para: __('Choose from different unique header layouts.', 'blossom-fashion'),
            buttonText: __('Learn More', 'blossom-fashion'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Layouts', 'blossom-fashion'),
            para: __('Choose layouts for blogs, banners, posts and more.', 'blossom-fashion'),
            buttonText: __('Learn More', 'blossom-fashion'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Sidebar', 'blossom-fashion'),
            para: __('Set different sidebars for posts and pages.', 'blossom-fashion'),
            buttonText: __('Learn More', 'blossom-fashion'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Sticky/Floating Menu', 'blossom-fashion'),
            para: __('Show a sticky/floating Menu for the site', 'blossom-fashion'),
            buttonText: __('Learn More', 'blossom-fashion'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Boost your website performance with ease.', 'blossom-fashion'),
            heading: __('Performance Settings', 'blossom-fashion'),
            buttonText: __('Learn More', 'blossom-fashion'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('You can create a one page scrollable website.', 'blossom-fashion'),
            heading: __('One Page Website', 'blossom-fashion'),
            buttonText: __('Learn More', 'blossom-fashion'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Import the demo content to kickstart your site.', 'blossom-fashion'),
            heading: __('One Click Demo Import', 'blossom-fashion'),
            buttonText: __('Learn More', 'blossom-fashion'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Easily place ads on high conversion areas.', 'blossom-fashion'),
            heading: __('Advertisement Settings', 'blossom-fashion'),
            buttonText: __('Learn More', 'blossom-fashion'),
            buttonUrl: cw_dashboard?.get_pro
        },
    ];

    const sidebarSettings = [
        {
            heading: __('We Value Your Feedback!', 'blossom-fashion'),
            icon: "star",
            para: __("Your review helps us improve and assists others in making informed choices. Share your thoughts today!", 'blossom-fashion'),
            imageurl: <Icon icon="review" />,
            buttonText: __('Leave a Review', 'blossom-fashion'),
            buttonUrl: cw_dashboard.review
        },
        {
            heading: __('Knowledge Base', 'blossom-fashion'),
            para: __("Need help using our theme? Visit our well-organized Knowledge Base!", 'blossom-fashion'),
            imageurl: <Icon icon="documentation" />,
            buttonText: __('Explore', 'blossom-fashion'),
            buttonUrl: cw_dashboard.docmentation
        },
        {
            heading: __('Need Assistance? ', 'blossom-fashion'),
            para: __("If you need help or have any questions, don't hesitate to contact our support team. We're here to assist you!", 'blossom-fashion'),
            imageurl: <Icon icon="supportTwo" />,
            buttonText: __('Submit a Ticket', 'blossom-fashion'),
            buttonUrl: cw_dashboard.support
        }
    ];

    return (
        <>
            <div className="customizer-settings">
                <div className="cw-customizer">
                    <div className="video-section">
                        <div className="cw-settings">
                            <h2>{__('Blossom Fashion Tutorial', 'blossom-fashion')}</h2>
                        </div>
                        <iframe src="https://www.youtube.com/embed/UD9HuSQQC9o?si=u_2a4evjDu506EWU" title={__( 'How to Start a Fashion Blog on WordPress | Blossom Fashion')} frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerPolicy="strict-origin-when-cross-origin" allowFullScreen></iframe>
                    </div>
                    <Heading
                        heading={__('Quick Customizer Settings', 'blossom-fashion')}
                        buttonText={__('Go To Customizer', 'blossom-fashion')}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={cardLists}
                        cardPlace='customizer'
                        cardCol='three-col'
                    />
                    <Heading
                        heading={__('More features with Pro version', 'blossom-fashion')}
                        buttonText={__('Go To Customizer', 'blossom-fashion')}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={proSettings}
                        cardPlace='cw-pro'
                        cardCol='two-col'
                    />
                    <div className="cw-button">
                        <a href={cw_dashboard?.get_pro} target="_blank" className="cw-button-btn primary-btn long-button">{__('Learn more about the Pro version', 'blossom-fashion')}</a>
                    </div>
                </div>
                <Sidebar sidebarSettings={sidebarSettings} openInNewTab={true} />
            </div>
        </>
    );
}

export default Homepage;