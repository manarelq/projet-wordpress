import { Icon, Card } from "../../components";
import { __ } from "@wordpress/i18n";
import { mainDemo, demo2, demo3, demo4, demo5 } from "../../components/images";

const StarterSites = () => {
    const cardList = [
        {
            heading: __('Default', 'blossom-fashion'),
            imageurl: mainDemo,
            buttonUrl: __('https://blossomthemesdemo.com/blossom-fashion-pro/', 'blossom-fashion'),
        },
        {
            heading: __('Travel', 'blossom-fashion'),
            imageurl: demo2,
            buttonUrl: __('https://blossomthemesdemo.com/fashion-pro-travel/', 'blossom-fashion'),
        },
        {
            heading: __('Stylish', 'blossom-fashion'),
            imageurl: demo3,
            buttonUrl: __('https://blossomthemesdemo.com/fashion-pro-stylish/', 'blossom-fashion'),
        },
        {
            heading: __('Diva', 'blossom-fashion'),
            imageurl: demo4,
            buttonUrl: __('https://blossomthemesdemo.com/fashion-pro-diva/', 'blossom-fashion'),
        },
        {
            heading: __('LifeStyle', 'blossom-fashion'),
            imageurl: demo5,
            buttonUrl: __('https://blossomthemesdemo.com/fashion-pro-lifestyle/', 'blossom-fashion'),
        }
    ]

    return (
        <>
            <Card
                cardList={cardList}
                cardPlace='starter'
                cardCol='three-col'
            />
            <div className="starter-sites-button cw-button">
                <a href={__('https://blossomthemes.com/theme-demo/?theme=blossom-fashion-pro&utm_source=blossom-fashion&utm_medium=dashboard&utm_campaign=theme_demo', 'blossom-fashion')} target="_blank" className="cw-button-btn outline">
                    {__('View All Demos', 'blossom-fashion')}
                    <Icon icon="arrowtwo" />
                </a>
            </div>
        </>
    );
}

export default StarterSites;