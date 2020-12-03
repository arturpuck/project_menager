const translations:object = {
    pl : {
        navbar : {
            projects : "Projekty",
            team : "Team",
            payouts : "Wypłaty",
            income : "Przychód",
            cashflow : "Cashflow",
            gantt : "Gantt",
            uploader : "Uploader",
            logout : "Wyloguj",
            projects_profitability : "Rentowność projektów"
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
            adding_project: "Dodawanie projektu",
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
            information : "Informacja",
            the_work_range_data_is_invalid : "Błędne dane zakresu pracy. Prawdopodobnie wybrany zakres już nie istnieje, lub w jakiś sposób zmodyfikowano dane przechowywane w elemencie select",
            the_data_is_invalid : "Próba pobrania danych klienta zakończyła się niepowodzeniem. Potencjalne przyczyny : klient został usunięty z bazy, ręcznie zmodyfikowano wartości pola wyboru klienta(element select) w nieprawidłowy sposób",
            server_error_occured : "Wystąpił błąd po stronie serwera",
            undefined_error : "Bliżej niezidentyfikowany błąd",
            fetching_client_data : "Pobieram dane klienta",
            in_order_to_select_an_employee_you_have_to_select_work_range : "Kontrolka jest chwilowo zablokowana, ponieważ aby wybrać pracownika należy najpierw wybrać zakres prac. Pobrana zostanie lista osób z wybraną umiejętnością",
            there_are_no_employees_with_this_skill : "Nie znaleziono pracowników z taką umiejętnością/biegłych w danym zakresie pracy"
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
            no_results_have_been_foound_for_your_authentication_level : "Nie znaleziono żadnych raportów odpowiadających Twojemu poziomowi uprawnień",
            the_data_is_invalid : "Wprowadzono nieprawidłowe dane",
            the_data_is_probably_ok_but_a_server_error_occured : "Wprowadzone dano najprawdopodobniej są poprawne, ale wystąpił błąd po stronie serwera",
            undefined_error : "Bliżej niezidentyfikowany błąd",
            report_saved_successfully : "Raport zapisany pomyślnie",
            full_name : "Imię i nazwisko",
            email : "Email",
            role : "Rola",
            phone_number : "Numer telefonu",
            add_position : "Dodaj stanowisko",
            positions : "Stanowiska",
            skills : "Umiejętności",
            add_skill : "Dodaj umiejętność",
            rate_per_hour_set_by_deal : "Stawka godzinowa na umowie",
            rate_per_month : "Stawka miesięczna",
            real_rate_per_hour : "Rzeczywista stawka godzinowa",
            note : "Notatka",
            employee_data_modified_successfully : "Pomyślnie zmodyfikowano dane pracownika",
            month_report : "Raport za miesiąc"
        },

        income : {
            you_have_to_select_some_status : "Płatność musi mieć przypisany jakiś status. Aktualizacja nieudana",
            status_changed_successfully : "Pomyślnie zmieniono status"
        },

        new_employee : {
           add_new_employee : "Dodaj nowego pracownika",
           login : "Login",
           email : "Email",
           password : "Hasło",
           confirm_password : "Potwierdź hasło",
           full_name : "Imię i nazwisko",
           phone_number : "Numer telefonu",
           rate_per_hour_set_by_deal : "Stawka godzinowa na umowie",
           real_rate_per_hour : "Rzeczywista stawka godzinowa",
           month_rate : "Stawka miesięczna",
           positions: "Stanowiska",
           add_skill : "Dodaj umiejętność",
           add_position : "Dodaj stanowisko",
           skills : "Umiejętności",
           save: "Dodaj "
        }
       
    }
};

export default function(packageName:string):string{
          const language = document.getElementsByTagName('html')[0].getAttribute('lang');
          return translations[language][packageName];
}