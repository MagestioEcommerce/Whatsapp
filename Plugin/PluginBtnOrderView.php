<?php

namespace Magestio\Whatsapp\Plugin;


class PluginBtnOrderView
{
    const PREFIXES = [
        "UK" => "44",
        "ES" => "34",
        "FR" => "33",
        "DE" => "49",
        "IT" => "39",
        "PT" => "351",
    ];

    public function beforeSetLayout(\Magento\Sales\Block\Adminhtml\Order\View $subject)
    {
        $phone = $subject->getOrder()->getShippingAddress()->getTelephone();
        $prefix = self::PREFIXES[$subject->getOrder()->getShippingAddress()->getCountryId()];
        if ($phone && $prefix) {
            $phone = $prefix . $phone;
            $subject->addButton(
                'send_whatsapp',
                [
                    'label' => __('Whatsapp'),
                    'onclick' => "window.open('https://api.whatsapp.com/send?phone=" . $phone . "', '_blank')",
                    'class' => 'whatsapp'
                ]
            );
        }


        return null;
    }
}
