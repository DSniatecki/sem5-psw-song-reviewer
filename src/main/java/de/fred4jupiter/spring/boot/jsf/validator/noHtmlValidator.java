package de.fred4jupiter.spring.boot.jsf.validator;


import javax.faces.application.FacesMessage;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.validator.FacesValidator;
import javax.faces.validator.Validator;
import javax.faces.validator.ValidatorException;

@FacesValidator("noHtmlValidator")
public class noHtmlValidator implements Validator {

    @Override
    public void validate(FacesContext context, UIComponent component, Object value) throws ValidatorException {
        if (value.toString().contains("/>")) {
            throw new ValidatorException(new FacesMessage("Value cannot contain html tags!"));
        }
    }

}