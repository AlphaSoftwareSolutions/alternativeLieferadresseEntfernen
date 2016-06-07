<?php

class Shopware_Plugins_Frontend_alternativeLieferadresseEntfernen_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{

    public function getInfo()
{
    return array(
        'author' => 'Edib Isic',
        'version' => $this->getVersion(),
        'label' => $this->getLabel(),
        'supplier' => 'edib-isic',
        'description' => '
<img src=""> </img>
Das Plugin Shopware lieferadresse Entfernen Plugin ist  automatisiert die Rechnungsstellung nach Bestelleingang vollständig. Über die Einstellungen können Sie konfigurieren, unter welchen Bedingungen eine Rechnung an den Kunden und ein Lieferschein z.B. an die Buchhaltung oder den Shopbetreiber gesandt werden sollen.
Gestalten Sie Ihre professionellen Rechnungen direkt im Shopware-Backend. Das Plugin versendet diese dann im PDF-Format mit allen wichtigen Bestellangaben an den Kunden. 
Vollständiger Funktionsumfang:
Erzeugung von Rechnung und Lieferschein im PDF-Format
Automatischer Versand der Rechnung an den Kunden. Optional Rechnung + Lieferschein an definierte E-Mail-Adressen.
Berücksichtigung des Zahlungs- & Bestellstatus: Wählen Sie einen bestimmten Zahlungs- und Bestellstatus, bei dem die Rechnung versandt werden soll.
Alle erzeugten Dokumente werden in der Bestellung hinterlegt und können jederzeit einfach im Backend aufgerufen werden.
Das Plugin unterstützt multilinguale Subshops inkl. übersetzte E-Mail- und Rechnungstemplates.
Export-Möglichkeit aller Rechnungen + Lieferscheine mit entsprechendem Dateinamen in ein Verzeichnis auf dem Server.
Beschränken Sie den Rechnungsversand auf einzelne Kundengruppen (z.B. Gewerbekunden) und Zahlungsmethoden.
Lieferschein und Rechnungskopie kann an eine E-Mail-Adresse des Shopbetreibers und z.B. der Buchhaltung gesendet werden.
Die Rechnung kann auch manuell per Knopfdruck direkt aus der Bestellansicht im Backend versandt werden.
Alle E-Mail-Vorlagen sind komfortabel über das Shopware-Backend editierbar. In den E-Mails stehen alle Variablen aus der sORDER-Email zur verfügung.
Alle Einstellungen können über das Backend bearbeitet werden.
Shopware AutoInvoice ist kompatibel mit Shopware 4 und Shopware 5. 
Kompatibilität mit anderen Plugins:
Neu: Kompatibel mit dem Magnalister, Coolbax und anderen Drittanbieter-Plugins zum Bestell-Import.
Kompatibel mit Backend-Bestellungen von Shopware.
Hier finden Sie die Plugin-Bedienungsanleitung
Bei Fragen, Problem oder Anregungen, sowie Anfragen zur Individualisierung des Plugins wenden Sie sich bitte an den kostenlosen Support

        Das leere Feld alternative Lieferadresse wird ausgeblendet.












        ',
        'support' => 'Edib Isic',
        'link' => 'http://1alpha-it.de'
    );
} 

    public function getVersion()
    {
        return '2.0.0';
    }

    public function getLabel()
    {
        return 'alternativeLieferadresseEntfernen';
    }

    public function install()
    {
        $this->subscribeEvent(
            'Enlight_Controller_Action_PostDispatchSecure_Frontend',
            'onFrontendPostDispatch'
        );

        $this->createConfig();

        return true;
    }

    private function createConfig()
    {
        $this->Form()->setElement(
            'textfield',
            'font-size',
            array(
                'label' => 'Font size',
                'store' => array(
                    array(12, '12px'),
                    array(18, '18px'),
                    array(25, '25px')
                ),
                'value' => 12
            )
        );

$form = $this->Form();
 
    $form->setElement('text', 'text', 
        array(
            'label' => 'Text',
            'value' => 'Vorauswahl',
            'scope' => Shopware\Models\Config\Element::SCOPE_SHOP,
            'description' => 'Dieses Plugin vereinfacht es dem Käufer den Kauf
            prozess zu beschleunigen'
        )
    );
    }

    public function onFrontendPostDispatch(Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->get('subject');
        $view = $controller->View();

        $view->addTemplateDir(
            __DIR__ . '/Views'
        );
        $view->extendsTemplate('frontend/plugins/slogan_of_the_day/index.tpl');   
    }
}
