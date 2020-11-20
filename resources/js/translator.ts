const translations:object = {
    pl : {
        navbar : {
            projects : "Projekty",
            team : "Team",
            payouts : "Wypłaty",
            income : "Dochód",
            cashflow : "Cashflow",
            gantt : "Gantt",
            uploader : "Uploader",
            logout : "Wyloguj"
        },

        projectsTable : {
            name_and_second_name : "Imię i nazwisko",
            no_results_have_been_foound_for_your_authentication_level : "Nie znaleziono żadnych projektów możliwych do wyświetlenia na Twoim poziomie uprawnień",
            the_data_is_invalid : "Przesłane dane są nieprawidłowe",
            undefined_error : "Bliżej niezidentyfikowany błąd",
            the_data_is_probably_ok_but_a_server_error_occured : "Wprowadzone dane są najprawdopodobniej poprawne, jednkaże pojawił się błąd po stronie serwera"
        },

        project_form : {
            client_data : "Dane klienta",
            client_contact_person : "Osoba do kontaktu",
            client_phone_number : "Telefon kontaktowy",
            client_email : "Email",
            close : "Zamknij",
            invoice_data : "Dane do faktury",
            company_name : "Nazwa firmy",
            tax_identification_number : "NIP",
            addres : "Adres",
            client : "Klient",
            project_basic_data : "Projekt - postawowe dane",
            name : "Nazwa",
            project_menager : "Project menager",
            work_range : "Zakres prac",
            choose_range : "Wybierz zakres",
            engaged_persons : "Zaangażowane osoby",
            choose_persons : "Wybierz osoby",
            work_stages : "Etapy prac",
            add_work_stage : "Dodaj etap pracy",
            engaged_person : "Zaangażowana osoba",
            estimated_number_of_hours : "Estymacja(godziny)",
            estimated_ammount_of_money : "Wycena(PLN)",
            start_at : "Data rozpoczęcia",
            deadline : "Deadline",
            payment_stages : "Etapy płatności",
            ammount : "Kwota(PLN)",
            estimated_date_of_invoice : "Przewidywana data wystawienia faktury",
            status : "Status",
            remove_work_stage : "Usuń etap pracy",
            remove_payment_stage : "Usuń etap płatności",
            add_payment_stage : "Dodaj etap płatności",
            summary : "Podsumowanie",
            valuation : "Wycena",
            total_cost : "Całkowity koszt",
            current_currency : "PLN",
            finish_date : "Data zakończenia",
            project_status : "Status projektu",
            project_comment : "Komentarz do projektu",
            save : "Zapisz",
            team : "Zespół",
            account : "Account",
            information : "Informacja"
        },

        employees_list : {
            full_name : "Imię i nazwisko",
            position : "Stanowisko",
            rate : "Stawka",
            technologies_and_skills : "Technologie/umiejętności",
            note : "Notatka",
            actions : "Działania",
            edit : "Edytuj",
            fetching_employees : "Pobieram listę pracowników",
        },

        employee_data : {
            projects_report : "Raport projektów",
            data : "dane",
            hours_of_work : "Przepracowane godziny",
            save : "Zapisz",
            project : "Projekt",
            range : "Zakres",
            time : "Czas",
            status : "Status",
            update_date: "Data aktualizacji",
            comment : "Komentarz",
            action : "Akcja",
            month : "miesiąc",
            year : "rok",
            filter_reports : "Filtruj raporty",
            clockify_report : "Raport clockify",
            no_results_have_been_foound_for_your_authentication_level : "Nie znaleziono żadnych wyników odpowiadających Twojemu poziomowi uprawnień",
            the_data_is_invalid : "Wprowadzono nieprawidłowe dane",
            the_data_is_probably_ok_but_a_server_error_occured : "Wprowadzone dano najprawdopodobniej są poprawne, ale wystąpił błąd po stronie serwera",
            undefined_error : "Bliżej niezidentyfikowany błąd",
            report_saved_successfully : "Raport zapisany pomyślnie",
        },
       
    }
};

export default function(packageName:string):string{
          const language = document.getElementsByTagName('html')[0].getAttribute('lang');
          return translations[language][packageName];
}